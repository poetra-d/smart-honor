@extends('layouts.app')

@section('title', 'Honor Rate Detail')
@section('page-title', 'Honor Rate Detail')

@section('content')

    <x-page-header title="Honor Rate Detail" subtitle="Finance">

        <div class="d-flex gap-2">

            <a href="{{ route('honor-rate.edit', $honorRate->id) }}" class="btn btn-warning">

                <i class="bi bi-pencil"></i>

                Edit

            </a>

            <a href="{{ route('honor-rate.index') }}" class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>

                Back

            </a>

        </div>

    </x-page-header>


    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Employment Status
                </div>

                <div class="col-md-9">
                    {{ $honorRate->employmentStatus->name }}
                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Rate per SKS
                </div>

                <div class="col-md-9">
                    Rp {{ number_format($honorRate->rate_per_sks, 0, ',', '.') }}
                </div>

            </div>


            <div class="row">

                <div class="col-md-3 fw-semibold">
                    Effective Date
                </div>

                <div class="col-md-9">
                    {{ \Carbon\Carbon::parse($honorRate->effective_date)->format('d F Y') }}
                </div>

            </div>

        </div>

    </div>

@endsection
