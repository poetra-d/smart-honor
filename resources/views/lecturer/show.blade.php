@extends('layouts.app')

@section('title', 'Lecturer Detail')
@section('page-title', 'Lecturer Detail')

@section('content')

    <x-page-header title="Lecturer Detail" subtitle="Master Data">

        <div class="d-flex gap-2">

            <a href="{{ route('lecturer.edit', $lecturer->id) }}" class="btn btn-warning">

                <i class="bi bi-pencil"></i>
                Edit

            </a>

            <a href="{{ route('lecturer.index') }}" class="btn btn-secondary">

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

                    {{ $lecturer->employee->user->username }}

                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">

                    Name

                </div>

                <div class="col-md-9">

                    {{ $lecturer->employee->user->name }}

                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">

                    Email

                </div>

                <div class="col-md-9">

                    {{ $lecturer->employee->user->email }}

                </div>

            </div>

            <div class="row">

                <div class="col-md-3 fw-semibold">

                    Role

                </div>

                <div class="col-md-9">

                    @forelse ($lecturer->employee->user->roles as $role)

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

                    Employment Status

                </div>

                <div class="col-md-9">

                    {{ $lecturer->employmentStatus->name }}

                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">

                    NIP

                </div>

                <div class="col-md-9">

                    {{ $lecturer->employee->nip }}

                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">

                    Name

                </div>

                <div class="col-md-9">

                    {{ $lecturer->employee->name }}

                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">

                    Email

                </div>

                <div class="col-md-9">

                    {{ $lecturer->employee->email }}

                </div>

            </div>

            <div class="row">

                <div class="col-md-3 fw-semibold">

                    Phone

                </div>

                <div class="col-md-9">

                    {{ $lecturer->employee->phone ?: '-' }}

                </div>

            </div>

        </div>

    </div>

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

                    {{ $lecturer->nidn }}

                </div>

            </div>

        </div>

    </div>

@endsection
