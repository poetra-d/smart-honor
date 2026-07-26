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

class HonorPaymentSummaryExport implements
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
        return HonorPayment::query()

            ->with([
                'lecturer.employee',
                'details',
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

            ->get()

            ->map(function ($payment) {

                return [

                    'lecturer' => $payment->lecturer->employee->name,

                    'period' => Carbon::create()
                        ->month((int) $payment->month)
                        ->translatedFormat('F')
                        . ' ' .
                        $payment->year,

                    'meeting' => $payment->details->count(),

                    'total' => $payment->total,

                    'status' => $payment->status,

                    'generated_at' => optional($payment->generated_at)
                        ?->format('d-m-Y H:i'),

                ];

            });
    }

    public function headings(): array
    {
        return [

            'Lecturer',
            'Period',
            'Total Meeting',
            'Total Honor',
            'Status',
            'Generated At',

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

            'D' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,

        ];
    }
}
