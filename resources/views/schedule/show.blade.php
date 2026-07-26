@extends('layouts.app')

@section('title', 'Schedule Detail')
@section('page-title', 'Schedule Detail')

@section('content')

    <x-page-header title="Schedule Detail" subtitle="Teaching">

        <div class="d-flex gap-2">

            <a href="{{ route('schedule.edit', $schedule->id) }}" class="btn btn-warning">

                <i class="bi bi-pencil"></i>
                Edit

            </a>


            <a href="{{ route('schedule.index') }}" class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>
                Back

            </a>

        </div>

    </x-page-header>


    <div class="card shadow-sm border-0">

        <form action="{{ route('schedule.generate-meeting', $schedule->id) }}" method="POST">

            @csrf

            <button class="btn btn-success" onclick="return confirm('Generate 16 meeting?')">

                <i class="bi bi-calendar-plus"></i>
                Generate Meeting

            </button>

        </form>

        <div class="card-header bg-white">

            <h5 class="mb-0">
                Schedule Information
            </h5>

        </div>


        <div class="card-body">


            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Academic Year
                </div>

                <div class="col-md-9">

                    {{ $schedule->courseOffering->academicYear->name }}

                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Semester
                </div>

                <div class="col-md-9">

                    {{ $schedule->courseOffering->semester->name }}

                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Course
                </div>

                <div class="col-md-9">

                    {{ $schedule->courseOffering->course->code }}
                    -
                    {{ $schedule->courseOffering->course->name }}

                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Class
                </div>

                <div class="col-md-9">

                    {{ $schedule->courseOffering->class->name }}

                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Lecturer
                </div>

                <div class="col-md-9">

                    {{ $schedule->courseOffering->lecturer->employee->name }}

                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Room
                </div>

                <div class="col-md-9">

                    {{ $schedule->room->name }}

                </div>

            </div>


            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Day
                </div>

                <div class="col-md-9">

                    {{ $schedule->day }}

                </div>

            </div>


            <div class="row">

                <div class="col-md-3 fw-semibold">
                    Time
                </div>

                <div class="col-md-9">

                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                    -
                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}

                </div>

            </div>


        </div>

    </div>


@endsection
