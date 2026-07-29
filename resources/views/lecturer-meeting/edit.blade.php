@extends('layouts.app')

@section('title', 'Fill Meeting')
@section('page-title', 'Fill Meeting')

@section('content')

    <x-alert />


    <x-page-header title="Fill Meeting" subtitle="Teaching" />


    <form action="{{ route('my-meeting.update', $meeting->id) }}" method="POST">

        @csrf
        @method('PUT')


        <div class="card shadow-sm border-0">

            <div class="card-body">


                <div class="mb-3">

                    <label class="form-label">
                        Course
                    </label>


                    <input type="text" class="form-control" readonly
                        value="{{ $meeting->schedule?->courseOffering?->course?->name }}">


                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Schedule
                    </label>

                    <input type="text" class="form-control" readonly value="
            {{ $meeting->schedule->day }}
            |
            {{ \Carbon\Carbon::parse($meeting->schedule?->start_time)->format('H:i') }}
            -
            {{ \Carbon\Carbon::parse($meeting->schedule?->end_time)->format('H:i') }}
            ">

                </div>



                <div class="mb-3">

                    <label class="form-label">
                        Meeting Number
                    </label>


                    <input type="text" class="form-control" readonly value="Pertemuan {{ $meeting->meeting_number }}">


                </div>



                <div class="mb-3">

                    <label class="form-label">
                        Meeting Date
                        <span class="text-danger">*</span>
                    </label>


                    <input type="date" name="meeting_date" class="form-control"
                        value="{{ old('meeting_date', $meeting->meeting_date) }}" required>

                </div>



                <div class="mb-3">

                    <label class="form-label">
                        Topic
                        <span class="text-danger">*</span>
                    </label>


                    <input type="text" name="topic" class="form-control" value="{{ old('topic', $meeting->topic) }}"
                        required>

                </div>



                <div class="mb-3">

                    <label class="form-label">
                        Description
                    </label>


                    <textarea name="description" class="form-control"
                        rows="4">{{ old('description', $meeting->description) }}</textarea>


                </div>



                <button class="btn btn-primary">

                    <i class="bi bi-check-lg"></i>
                    Submit

                </button>


                <a href="{{ route('my-meeting.index') }}" class="btn btn-secondary">

                    Back

                </a>


            </div>

        </div>


    </form>


@endsection
