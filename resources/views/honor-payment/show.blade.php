@extends('layouts.app')

@section('title', 'Honor Payment Detail')
@section('page-title', 'Honor Payment Detail')


@section('content')

<x-alert />


<x-page-header
    title="Honor Payment Detail"
    subtitle="Finance"
/>



<div class="card shadow-sm border-0 mb-3">

    <div class="card-body">


        <div class="row">


            <div class="col-md-4">

                <small class="text-muted">
                    Lecturer
                </small>

                <h5>
                    {{ $honorPayment->lecturer->employee->name ?? '-' }}
                </h5>

            </div>


            <div class="col-md-3">

                <small class="text-muted">
                    Period
                </small>

                <h5>

                    {{ \Carbon\Carbon::create()
    ->month((int) $honorPayment->month)
    ->translatedFormat('F')
}}

                    {{ $honorPayment->year }}

                </h5>

            </div>



            <div class="col-md-2">

                <small class="text-muted">
                    Status
                </small>


                <div>

                    @switch($honorPayment->status)


                        @case(\App\Models\HonorPayment::STATUS_DRAFT)

                            <span class="badge bg-warning">
                                Draft
                            </span>

                        @break



                        @case(\App\Models\HonorPayment::STATUS_PAID)

                            <span class="badge bg-success">
                                Paid
                            </span>

                        @break



                        @case(\App\Models\HonorPayment::STATUS_CANCELLED)

                            <span class="badge bg-danger">
                                Cancelled
                            </span>

                        @break


                    @endswitch

                </div>

            </div>


            <div class="col-md-3 text-end">


                @if($honorPayment->status == \App\Models\HonorPayment::STATUS_DRAFT)


                    <form
                        action="{{ route('honor-payment.paid',$honorPayment) }}"
                        method="POST"
                        class="d-inline">


                        @csrf
                        @method('PUT')


                        <button class="btn btn-success">

                            <i class="bi bi-check-circle"></i>

                            Paid

                        </button>


                    </form>



                    <form
                        action="{{ route('honor-payment.cancel',$honorPayment) }}"
                        method="POST"
                        class="d-inline">


                        @csrf
                        @method('PUT')


                        <button class="btn btn-danger">


                            <i class="bi bi-x-circle"></i>

                            Cancel


                        </button>


                    </form>


                @endif


            </div>


        </div>


    </div>

</div>





<div class="card shadow-sm border-0">


<div class="card-body">


<div class="table-responsive">


<table class="table table-hover align-middle">


<thead class="table-light">


<tr>

<th width="60">
No
</th>


<th>
Course
</th>


<th>
Meeting
</th>


<th>
Date
</th>


<th>
SKS
</th>


<th>
Rate
</th>


<th class="text-end">
Subtotal
</th>


</tr>


</thead>



<tbody>


@forelse($honorPayment->details as $index => $detail)


<tr>


<td>

{{ $index + 1 }}

</td>



<td>


{{ $detail->courseOffering->course->code ?? '-' }}

-

{{ $detail->courseOffering->course->name ?? '-' }}


</td>



<td>


Pertemuan
{{ $detail->meeting->meeting_number ?? '-' }}


</td>



<td>


{{ $detail->meeting?->meeting_date
    ? \Carbon\Carbon::parse(
        $detail->meeting->meeting_date
    )->format('d-m-Y')
    : '-'
}}


</td>



<td>

{{ $detail->sks }}

</td>



<td>


Rp {{ number_format(
    $detail->rate,
    0,
    ',',
    '.'
) }}


</td>



<td class="text-end">


Rp {{ number_format(
    $detail->subtotal,
    0,
    ',',
    '.'
) }}


</td>


</tr>


@empty


<tr>


<td colspan="7"
class="text-center text-muted">

Belum ada detail honor

</td>


</tr>


@endforelse



</tbody>



<tfoot>


<tr>


<th colspan="6"
class="text-end">

Total

</th>


<th class="text-end">


Rp {{ number_format(
    $honorPayment->total,
    0,
    ',',
    '.'
) }}


</th>


</tr>


</tfoot>



</table>


</div>


<a href="{{ route('honor-payment.index') }}"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>

Kembali

</a>


</div>


</div>



@endsection
