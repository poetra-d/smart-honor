@extends('layouts.app')

@section('title', 'Meeting Detail')
@section('page-title', 'Meeting Detail')

@section('content')

    <x-page-header title="Meeting Detail" subtitle="Teaching">

        <div class="d-flex gap-2">

            <a href="{{ route('meeting.edit', $meeting->id) }}" class="btn btn-warning">

                <i class="bi bi-pencil"></i>
                Edit

            </a>


            <a href="{{ route('meeting.index') }}" class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>
                Back

            </a>

        </div>

    </x-page-header>



    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <h5 class="mb-0">
                Meeting Information
            </h5>

        </div>


        <div class="card-body">


            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Course
                </div>

                <div class="col-md-9">

                    {{ $meeting->schedule->courseOffering->course->code }}
                    -
                    {{ $meeting->schedule->courseOffering->course->name }}

                </div>

            </div>



            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Class
                </div>

                <div class="col-md-9">

                    {{ $meeting->schedule->courseOffering->class->name }}

                </div>

            </div>



            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Lecturer
                </div>

                <div class="col-md-9">

                    {{ $meeting->schedule->courseOffering->lecturer->employee->name }}

                </div>

            </div>



            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Schedule
                </div>

                <div class="col-md-9">

                    {{ $meeting->schedule->day }}

                    <br>

                    {{ \Carbon\Carbon::parse($meeting->schedule->start_time)->format('H:i') }}
                    -
                    {{ \Carbon\Carbon::parse($meeting->schedule->end_time)->format('H:i') }}

                </div>

            </div>



            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Meeting Number
                </div>

                <div class="col-md-9">

                    Pertemuan {{ $meeting->meeting_number }}

                </div>

            </div>



            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Meeting Date
                </div>

                <div class="col-md-9">

                    {{ $meeting->meeting_date
        ? \Carbon\Carbon::parse($meeting->meeting_date)->format('d-m-Y')
        : '-'
                        }}

                </div>

            </div>



            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Topic
                </div>

                <div class="col-md-9">

                    {{ $meeting->topic ?? '-' }}

                </div>

            </div>



            <div class="row mb-3">

                <div class="col-md-3 fw-semibold">
                    Description
                </div>

                <div class="col-md-9">

                    {{ $meeting->description ?? '-' }}

                </div>

            </div>



            <div class="row">

                <div class="col-md-3 fw-semibold">
                    Status
                </div>

                <div class="col-md-9">


                    @if($meeting->status == 'Selesai')

                        <span class="badge bg-success">
                            Selesai
                        </span>

                    @else

                        <span class="badge bg-secondary">
                            Terjadwal
                        </span>

                    @endif


                </div>

            </div>


        </div>

    </div>


@endsection
