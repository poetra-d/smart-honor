@extends('layouts.app')

@section('title', 'My Honor')
@section('page-title', 'My Honor')


@section('content')

    <x-alert />

    <x-page-header title="My Honor" subtitle="Teaching" />



    <div class="row mb-3">


        <div class="col-md-6">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <small class="text-muted">
                        Total Payment
                    </small>

                    <h3>

                        {{ $summary->total_payment ?? 0 }}

                    </h3>

                </div>

            </div>

        </div>



        <div class="col-md-6">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <small class="text-muted">
                        Total Honor
                    </small>

                    <h3>

                        Rp {{ number_format(
        $summary->total_honor ?? 0,
        0,
        ',',
        '.'
    ) }}

                    </h3>

                </div>

            </div>

        </div>


    </div>





    <div class="card shadow-sm border-0 mb-3">


        <div class="card-body">


            <form method="GET">


                <div class="row">


                    <div class="col-md-4">

                        <label class="form-label">
                            Month
                        </label>


                        <select name="month" class="form-select">


                            <option value="">
                                All
                            </option>


                            @foreach(range(1, 12) as $month)

                                                <option value="{{ $month }}" @selected(request('month') == $month)>

                                                    {{ \Carbon\Carbon::create()
                                ->month($month)
                                ->translatedFormat('F') }}

                                                </option>

                            @endforeach


                        </select>

                    </div>




                    <div class="col-md-4">

                        <label class="form-label">
                            Year
                        </label>


                        <input type="number" name="year" value="{{ request('year') }}" class="form-control">

                    </div>




                    <div class="col-md-4 d-flex align-items-end">


                        <button class="btn btn-primary">

                            <i class="bi bi-search"></i>

                            Search

                        </button>


                        <a href="{{ route('my-honor.index') }}" class="btn btn-secondary ms-2">

                            Reset

                        </a>


                    </div>



                </div>


            </form>


        </div>


    </div>





    <div class="card shadow-sm border-0">


        <div class="card-body">


            <table class="table table-hover align-middle">


                <thead class="table-light">


                    <tr>

                        <th width="60">
                            No
                        </th>


                        <th>
                            Period
                        </th>


                        <th>
                            Generated
                        </th>


                        <th>
                            Total
                        </th>


                        <th>
                            Status
                        </th>


                        <th width="100">
                            Action
                        </th>


                    </tr>


                </thead>



                <tbody>


                    @forelse($payments as $index => $payment)


                                        <tr>


                                            <td>

                                                {{ $payments->firstItem() + $index }}

                                            </td>



                                            <td>


                                                {{ \Carbon\Carbon::create()
                                ->month((int) $payment->month)
                                ->translatedFormat('F')
                        }}

                                                {{ $payment->year }}


                                            </td>



                                            <td>


                                                {{ $payment->generated_at
                                ? $payment->generated_at->format('d M Y')
                                : '-'
                        }}


                                            </td>



                                            <td>


                                                Rp {{ number_format(
                                $payment->total,
                                0,
                                ',',
                                '.'
                            ) }}


                                            </td>



                                            <td>


                                                @if($payment->status == \App\Models\HonorPayment::STATUS_PAID)

                                                    <span class="badge bg-success">
                                                        Paid
                                                    </span>


                                                @elseif($payment->status == \App\Models\HonorPayment::STATUS_DRAFT)

                                                    <span class="badge bg-warning">
                                                        Draft
                                                    </span>


                                                @else

                                                    <span class="badge bg-danger">
                                                        Cancelled
                                                    </span>


                                                @endif


                                            </td>



                                            <td>


                                                <a href="{{ route(
                                'my-honor.show',
                                [
                                    'honorPayment' => $payment->id
                                ]
                            ) }}" class="btn btn-info btn-sm">


                                                    <i class="bi bi-eye"></i>


                                                </a>


                                            </td>


                                        </tr>


                    @empty


                        <tr>

                            <td colspan="6" class="text-center text-muted">

                                Belum ada honor

                            </td>

                        </tr>


                    @endforelse


                </tbody>


            </table>



            @if($payments->hasPages())

                {{ $payments->links() }}

            @endif


        </div>


    </div>



@endsection
