@extends('layouts.app')

@section('title', 'Honor Detail')
@section('page-title', 'Honor Detail')


@section('content')

    <x-alert />

    <x-page-header title="Honor Detail" subtitle="Teaching" />



    <div class="card shadow-sm border-0 mb-3">

        <div class="card-body">


            <div class="row">


                <div class="col-md-4">

                    <small class="text-muted">
                        Period
                    </small>


                    <h5 class="mb-0">


                        {{ \Carbon\Carbon::create()
        ->month((int) $honorPayment->month)
        ->translatedFormat('F')
                        }}

                        {{ $honorPayment->year }}


                    </h5>


                </div>




                <div class="col-md-4">


                    <small class="text-muted">
                        Status
                    </small>


                    <h5>


                        @if($honorPayment->status == \App\Models\HonorPayment::STATUS_PAID)


                            <span class="badge bg-success">

                                Paid

                            </span>


                        @elseif($honorPayment->status == \App\Models\HonorPayment::STATUS_DRAFT)


                            <span class="badge bg-warning">

                                Draft

                            </span>


                        @else


                            <span class="badge bg-danger">

                                Cancelled

                            </span>


                        @endif


                    </h5>


                </div>





                <div class="col-md-4 text-end">


                    <small class="text-muted">
                        Total Honor
                    </small>


                    <h4 class="mb-0">


                        Rp {{ number_format(
        $honorPayment->total,
        0,
        ',',
        '.'
    ) }}


                    </h4>


                </div>



            </div>


        </div>


    </div>





    <div class="card shadow-sm border-0">


        <div class="card-body">


            <div class="table-responsive">


                <table class="table table-striped table-hover align-middle">


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


                            <th>
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





                                                <td>


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


                                <td colspan="7" class="text-center text-muted">


                                    Belum ada detail honor


                                </td>


                            </tr>


                        @endforelse



                    </tbody>


                </table>


            </div>



            <a href="{{ route('my-honor.index') }}" class="btn btn-secondary">


                <i class="bi bi-arrow-left"></i>

                Kembali


            </a>



        </div>


    </div>



@endsection
