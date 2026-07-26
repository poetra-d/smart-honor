@extends('layouts.app')

@section('title', 'Generate Honor Payment')
@section('page-title', 'Generate Honor Payment')


@section('content')

    <x-alert />


    <x-page-header title="Generate Honor Payment" subtitle="Finance" />


    <div class="card shadow-sm border-0">


        <div class="card-body">


            <form method="POST" action="{{ route('honor-payment.generate') }}">


                @csrf


                <div class="row">


                    <div class="col-md-4">


                        <label class="form-label">
                            Month
                        </label>


                        <select name="month" class="form-select" required>


                            <option value="">
                                -- Select Month --
                            </option>


                            @foreach(range(1, 12) as $month)


                                                        <option value="{{ $month }}" {{ old('month') == $month ? 'selected' : '' }}>


                                                            {{ \Carbon\Carbon::create()
                                        ->month($month)
                                        ->translatedFormat('F')
                                }}


                                                        </option>


                            @endforeach


                        </select>


                    </div>




                    <div class="col-md-4">


                        <label class="form-label">
                            Year
                        </label>


                        <input type="number" name="year" class="form-control" value="{{ old('year', now()->year) }}"
                            required>


                    </div>



                    <div class="col-md-4 d-flex align-items-end">


                        <button class="btn btn-primary">


                            <i class="bi bi-calculator"></i>


                            Generate


                        </button>


                        <a href="{{ route('honor-payment.index') }}" class="btn btn-secondary ms-2">


                            Cancel


                        </a>


                    </div>


                </div>


            </form>


        </div>


    </div>


@endsection
