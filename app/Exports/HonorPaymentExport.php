<?php

namespace App\Exports;

use App\Exports\Sheets\HonorPaymentDetailSheet;
use App\Exports\Sheets\HonorPaymentSummarySheet;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HonorPaymentExport implements WithMultipleSheets
{
    use Exportable;

    public function __construct(
        protected Request $request
    ) {}

    public function sheets(): array
    {
        return [

            new HonorPaymentSummarySheet($this->request),

            new HonorPaymentDetailSheet($this->request),

        ];
    }
}
