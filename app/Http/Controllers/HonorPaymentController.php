<?php
namespace App\Http\Controllers;

use App\Exports\HonorPaymentDetailExport;
use App\Exports\HonorPaymentSummaryExport;
use App\Models\HonorPayment;
use App\Models\HonorPaymentDetail;
use App\Models\HonorRate;
use App\Models\Meeting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class HonorPaymentController extends Controller
{
    private function generateFilename(
        string $type,
        Request $request
    ): string {

        $filename = 'Honor-Payment-' . $type;

        if ($request->filled('month')) {

            $filename .= '-'
            . Carbon::create()
                ->month((int) $request->month)
                ->format('F');

        }

        if ($request->filled('year')) {

            $filename .= '-' . $request->year;

        }

        if ($request->filled('status')) {

            $filename .= '-' . ucfirst($request->status);

        }

        return $filename . '.xlsx';

    }

    public function index(Request $request)
    {
        $query = HonorPayment::query()
            ->with([
                'lecturer.employee',
            ])

            ->when($request->filled('month'), function ($query) use ($request) {

                $query->where(
                    'month',
                    $request->month
                );

            })

            ->when($request->filled('year'), function ($query) use ($request) {

                $query->where(
                    'year',
                    $request->year
                );

            })

            ->when($request->filled('status'), function ($query) use ($request) {

                $query->where(
                    'status',
                    $request->status
                );

            });

        $summary = (clone $query)
            ->selectRaw(
                "
                COUNT(*) as total_payment,

                COALESCE(SUM(total),0) as total_honor,

                SUM(
                    CASE
                        WHEN status = ?
                        THEN 1
                        ELSE 0
                    END
                ) as total_draft,


                SUM(
                    CASE
                        WHEN status = ?
                        THEN 1
                        ELSE 0
                    END
                ) as total_paid

                ",
                [
                    HonorPayment::STATUS_DRAFT,
                    HonorPayment::STATUS_PAID,
                ]
            )
            ->first();

        $payments = $query

            ->orderByDesc('year')

            ->orderByDesc('month')

            ->paginate(10)

            ->withQueryString();

        return view(
            'honor-payment.index',
            compact(
                'payments',
                'summary'
            )
        );
    }

    /**
     * Form generate payment
     */
    public function generateForm()
    {
        return view(
            'honor-payment.generate'
        );
    }

    /**
     * Generate payment
     */
    public function generate(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'month' => [
                'required',
                'integer',
                'between:1,12',
            ],

            'year'  => [
                'required',
                'integer',
                'digits:4',
            ],

        ]);

        if ($validator->fails()) {

            return back()
                ->withErrors($validator)
                ->withInput();

        }

        DB::beginTransaction();

        try {

            $meetings = Meeting::query()

                ->with([
                    'schedule.courseOffering.course',
                    'schedule.courseOffering.lecturer.employee',
                ])

                ->where(
                    'status',
                    Meeting::STATUS_COMPLETED
                )

                ->whereMonth(
                    'meeting_date',
                    $request->month
                )

                ->whereYear(
                    'meeting_date',
                    $request->year
                )

                ->where(function ($query) {

                    $query->whereDoesntHave('paymentDetail')

                        ->orWhereHas('paymentDetail.payment', function ($q) {

                            $q->where(
                                'status',
                                HonorPayment::STATUS_CANCELLED
                            );

                        });

                })

                ->get();

            if ($meetings->isEmpty()) {

                DB::rollBack();

                return back()

                    ->with(
                        'error',
                        'Tidak ada meeting selesai yang bisa diproses.'
                    );

            }

            $groupedMeetings = $meetings->groupBy(function ($meeting) {

                return $meeting
                    ->schedule
                    ->courseOffering
                    ->lecturer_id;

            });

            foreach ($groupedMeetings as $lecturerId => $lecturerMeetings) {

                $payment = HonorPayment::create([

                    'lecturer_id'  => $lecturerId,

                    'month'        => $request->month,

                    'year'         => $request->year,

                    'total'        => 0,

                    'status'       => HonorPayment::STATUS_DRAFT,

                    'generated_by' => auth()->id(),

                    'generated_at' => now(),

                ]);

                $total = 0;

                foreach ($lecturerMeetings as $meeting) {

                    $courseOffering = $meeting
                        ->schedule
                        ->courseOffering;

                    $lecturer = $courseOffering
                        ->lecturer;

                    $rate = HonorRate::query()

                        ->where(
                            'employment_status_id',
                            $lecturer->employment_status_id
                        )

                        ->where(
                            'effective_date',
                            '<=',
                            $meeting->meeting_date
                        )

                        ->orderByDesc(
                            'effective_date'
                        )

                        ->first();

                    if (! $rate) {

                        throw new \Exception(

                            'Honor rate belum tersedia untuk dosen '
                            .
                            ($lecturer->employee->name ?? '-')

                        );

                    }

                    $sks = $courseOffering
                        ->course
                        ->sks;

                    $subtotal = $sks * $rate->rate_per_sks;

                    HonorPaymentDetail::create([

                        'payment_id'         => $payment->id,

                        'meeting_id'         => $meeting->id,

                        'course_offering_id' => $courseOffering->id,

                        'sks'                => $sks,

                        'rate'               => $rate->rate_per_sks,

                        'subtotal'           => $subtotal,

                    ]);

                    $total += $subtotal;

                }

                $payment->update([

                    'total' => $total,

                ]);

            }

            DB::commit();

            return redirect()

                ->route('honor-payment.index')

                ->with(
                    'success',
                    'Honor payment berhasil digenerate.'
                );

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()

                ->withInput()

                ->with(
                    'error',
                    $e->getMessage()
                );

        }

    }

    /**
     * Detail payment
     */
    public function show(HonorPayment $honorPayment)
    {

        $honorPayment->load([

            'lecturer.employee',

            'details.meeting',

            'details.courseOffering.course',

        ]);

        return view(

            'honor-payment.show',

            compact(
                'honorPayment'
            )

        );

    }

    /**
     * Paid payment
     */
    public function paid(HonorPayment $honorPayment)
    {

        if (
            $honorPayment->status
            !=
            HonorPayment::STATUS_DRAFT
        ) {

            return back()

                ->with(
                    'error',
                    'Payment tidak dapat dibayar.'
                );

        }

        $honorPayment->update([

            'status'  => HonorPayment::STATUS_PAID,

            'paid_at' => now(),

        ]);

        return back()

            ->with(
                'success',
                'Honor payment berhasil dibayar.'
            );

    }

    /**
     * Cancel payment
     */
    public function cancel(HonorPayment $honorPayment)
    {

        if (
            $honorPayment->status
            !=
            HonorPayment::STATUS_DRAFT
        ) {

            return back()

                ->with(
                    'error',
                    'Payment tidak dapat dibatalkan.'
                );

        }

        $honorPayment->update([

            'status'  => HonorPayment::STATUS_CANCELLED,

            'paid_at' => null,

        ]);

        return back()

            ->with(
                'success',
                'Payment berhasil dibatalkan.'
            );

    }

    public function exportSummary(Request $request)
    {
        $filename = 'Honor-Payment-Summary';

        if ($request->filled('month')) {

            $filename .= '-'
            . Carbon::create()
                ->month((int) $request->month)
                ->format('F');

        }

        if ($request->filled('year')) {

            $filename .= '-'
            . $request->year;

        }

        if ($request->filled('status')) {

            $filename .= '-'
            . ucfirst(strtolower($request->status));

        }

        $filename .= '.xlsx';

        return Excel::download(

            new HonorPaymentSummaryExport($request),

            $filename

        );
    }

    public function exportDetail(Request $request)
    {
        $filename = 'Honor-Payment-Detail';

        if ($request->filled('month')) {

            $filename .= '-'
            . Carbon::create()
                ->month((int) $request->month)
                ->format('F');

        }

        if ($request->filled('year')) {

            $filename .= '-' . $request->year;

        }

        if ($request->filled('status')) {

            $filename .= '-' . ucfirst(strtolower($request->status));

        }

        $filename .= '.xlsx';

        return Excel::download(
            new HonorPaymentDetailExport($request),
            $filename
        );
    }
}
