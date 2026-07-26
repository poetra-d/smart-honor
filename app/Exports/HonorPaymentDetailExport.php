<?php

namespace App\Exports;

use App\Models\HonorPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HonorPaymentDetailExport implements
    FromCollection,
    WithHeadings,
    ShouldAutoSize,
    WithStyles,
    WithColumnFormatting
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $payments = HonorPayment::query()

            ->with([
                'lecturer.employee',
                'details.meeting',
                'details.courseOffering.course',
                'details.courseOffering.class',
            ])

            ->when($this->request->filled('month'), function ($q) {
                $q->where('month', $this->request->month);
            })

            ->when($this->request->filled('year'), function ($q) {
                $q->where('year', $this->request->year);
            })

            ->when($this->request->filled('status'), function ($q) {
                $q->where('status', $this->request->status);
            })

            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get();

        return $payments->flatMap(function ($payment) {

            return $payment->details->map(function ($detail) use ($payment) {

                return [

                    'lecturer' => $payment
                        ->lecturer
                        ->employee
                        ->name,

                    'period' => Carbon::create()
                        ->month((int) $payment->month)
                        ->translatedFormat('F')
                        .' '.$payment->year,

                    'course' => $detail
                        ->courseOffering
                        ->course
                        ->code
                        .' - '.
                        $detail
                        ->courseOffering
                        ->course
                        ->name,

                    'class' => $detail
                        ->courseOffering
                        ->class
                        ->name,

                    'meeting' => $detail
                        ->meeting
                        ->meeting_number,

                    'meeting_date' => optional(
                        $detail->meeting->meeting_date
                    )
                        ? Carbon::parse(
                            $detail->meeting->meeting_date
                        )->format('d-m-Y')
                        : '-',

                    'sks' => $detail->sks,

                    'rate' => $detail->rate,

                    'subtotal' => $detail->subtotal,

                    'status' => $payment->status,

                ];

            });

        });

    }

    public function headings(): array
    {
        return [

            'Lecturer',
            'Period',
            'Course',
            'Class',
            'Meeting',
            'Meeting Date',
            'SKS',
            'Rate',
            'Subtotal',
            'Status',

        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [

            1 => [

                'font' => [

                    'bold' => true,

                ],

            ],

        ];
    }

    public function columnFormats(): array
    {
        return [

            'H' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,

            'I' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,

        ];
    }
}
