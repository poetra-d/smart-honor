@extends('layouts.app')

@section('title', 'Course Offering Detail')
@section('page-title', 'Course Offering Detail')

@section('content')

    <x-page-header title="Course Offering Detail" subtitle="Academic">

        <div class="d-flex gap-2">

            <a href="{{ route('course-offering.edit', $courseOffering->id) }}" class="btn btn-warning">

                <i class="bi bi-pencil"></i>
                Edit

            </a>

            <a href="{{ route('course-offering.index') }}" class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>
                Back

            </a>

        </div>

    </x-page-header>

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-white">

            <h5 class="mb-0">
                Course Offering Information
            </h5>

        </div>

        <div class="card-body">

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Academic Year
                </div>

                <div class="col-md-9">
                    {{ $courseOffering->academicYear?->name }}
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Semester
                </div>

                <div class="col-md-9">
                    {{ $courseOffering->semester?->name }}
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Study Program
                </div>

                <div class="col-md-9">
                    {{ $courseOffering->course?->studyProgram?->name }}
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Course
                </div>

                <div class="col-md-9">
                    {{ $courseOffering->course?->code }}
                    -
                    {{ $courseOffering->course?->name }}
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Class
                </div>

                <div class="col-md-9">
                    {{ $courseOffering->class?->code }}
                    -
                    {{ $courseOffering->class?->name }}
                </div>

            </div>

            <div class="row">

                <div class="col-md-3 fw-semibold">
                    Quota
                </div>

                <div class="col-md-9">
                    {{ $courseOffering->quota }}
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

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    NIDN
                </div>

                <div class="col-md-9">
                    {{ $courseOffering->lecturer?->nidn }}
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    NIP
                </div>

                <div class="col-md-9">
                    {{ $courseOffering->lecturer?->employee?->nip }}
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Name
                </div>

                <div class="col-md-9">
                    {{ $courseOffering->lecturer?->employee?->name }}
                </div>

            </div>

            <div class="row">

                <div class="col-md-3 fw-semibold">
                    Employment Status
                </div>

                <div class="col-md-9">
                    {{ $courseOffering->lecturer?->employmentStatus?->name }}
                </div>

            </div>

        </div>

    </div>

@endsection
