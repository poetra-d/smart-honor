@extends('layouts.app')

@section('title', 'Employee Detail')
@section('page-title', 'Employee Detail')

@section('content')

    <x-page-header title="Employee Detail" subtitle="Master Data">

        <div class="d-flex gap-2">

            <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-warning">

                <i class="bi bi-pencil"></i>
                Edit

            </a>

            <a href="{{ route('employee.index') }}" class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>
                Back

            </a>

        </div>

    </x-page-header>

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                Account Information

            </h5>

        </div>

        <div class="card-body">

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">

                    Username

                </div>

                <div class="col-md-9">

                    {{ $employee->user->username }}

                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">

                    Name

                </div>

                <div class="col-md-9">

                    {{ $employee->user->name }}

                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">

                    Email

                </div>

                <div class="col-md-9">

                    {{ $employee->user->email }}

                </div>

            </div>

            <div class="row">

                <div class="col-md-3 fw-semibold">

                    Role

                </div>

                <div class="col-md-9">

                    @forelse ($employee->user->roles as $role)

                        <span class="badge bg-primary">

                            {{ ucwords($role->name) }}

                        </span>

                    @empty

                        <span class="badge bg-secondary">

                            No Role

                        </span>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                Employee Information

            </h5>

        </div>

        <div class="card-body">

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">

                    NIP

                </div>

                <div class="col-md-9">

                    {{ $employee->nip }}

                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">

                    Name

                </div>

                <div class="col-md-9">

                    {{ $employee->name }}

                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">

                    Email

                </div>

                <div class="col-md-9">

                    {{ $employee->email }}

                </div>

            </div>

            <div class="row">

                <div class="col-md-3 fw-semibold">

                    Phone

                </div>

                <div class="col-md-9">

                    {{ $employee->phone ?: '-' }}

                </div>

            </div>

        </div>

    </div>

    @if ($employee->lecturer)

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    Lecturer Information

                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3 fw-semibold">

                        NIDN

                    </div>

                    <div class="col-md-9">

                        {{ $employee->lecturer->nidn }}

                    </div>

                </div>

            </div>

        </div>

    @endif

@endsection
