<?php
namespace App\Http\Controllers;

use App\Models\HonorPayment;
use Illuminate\Http\Request;

class LecturerHonorController extends Controller
{
    public function index(Request $request)
    {
        $employee = auth()
            ->user()
            ->employee;

        if (! $employee || ! $employee->lecturer) {
            abort(403, 'User bukan lecturer.');
        }

        $lecturer = $employee->lecturer;

        $query = HonorPayment::query()

            ->with([
                'details',
            ])

            ->where(
                'lecturer_id',
                $lecturer->id
            )

            ->when($request->month, function ($q) use ($request) {

                $q->where(
                    'month',
                    $request->month
                );

            })

            ->when($request->year, function ($q) use ($request) {

                $q->where(
                    'year',
                    $request->year
                );

            })

            ->when($request->status, function ($q) use ($request) {

                $q->where(
                    'status',
                    $request->status
                );

            });

        $summary = (clone $query)

            ->selectRaw('
                COUNT(*) as total_payment,
                COALESCE(SUM(total),0) as total_honor
            ')

            ->where('status', HonorPayment::STATUS_PAID)

            ->first();

        $payments = $query

            ->orderByDesc('year')

            ->orderByDesc('month')

            ->paginate(10)

            ->withQueryString();

        return view(
            'lecturer-honor.index',
            compact(
                'payments',
                'summary'
            )
        );
    }

    public function show(HonorPayment $honorPayment)
    {
        $employee = auth()
            ->user()
            ->employee;

        if (! $employee || ! $employee->lecturer) {

            abort(403);

        }

        $lecturer = $employee->lecturer;
        // keamanan:
        // dosen hanya boleh lihat payment miliknya

        if ($honorPayment->lecturer_id != $lecturer->id) {

            abort(403);

        }

        $honorPayment->load([

            'details.meeting',

            'details.courseOffering.course',

        ]);

        return view(
            'lecturer-honor.show',
            compact(
                'honorPayment'
            )
        );
    }

}
