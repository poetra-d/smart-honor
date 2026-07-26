@extends('layouts.app')

@section('title', 'Meeting')
@section('page-title', 'Meeting')

@section('content')

    <x-alert />

    <x-page-header title="Meeting" subtitle="Teaching">

        <a href="{{ route('meeting.create') }}" class="btn btn-primary">

            <i class="bi bi-plus-lg"></i>
            Add Meeting

        </a>

    </x-page-header>


    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form method="GET" action="{{ route('meeting.index') }}">

                <div class="row mb-3">

                    <div class="col-md-4">

                        <input type="text" name="search" class="form-control" placeholder="Search course..."
                            value="{{ request('search') }}">

                    </div>


                    <div class="col-md-2">

                        <button class="btn btn-secondary">

                            Search

                        </button>

                    </div>

                </div>

            </form>


            <div class="table-responsive">

                <table class="table table-striped table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th width="70">
                                No
                            </th>

                            <th>
                                Course
                            </th>

                            <th>
                                Class
                            </th>

                            <th>
                                Lecturer
                            </th>

                            <th>
                                Meeting
                            </th>

                            <th>
                                Date
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="140">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($meetings as $index => $meeting)

                                        <tr>

                                            <td>
                                                {{ $meetings->firstItem() + $index }}
                                            </td>


                                            <td>

                                                {{ $meeting->schedule->courseOffering->course->code }}
                                                -
                                                {{ $meeting->schedule->courseOffering->course->name }}

                                            </td>


                                            <td>

                                                {{ $meeting->schedule->courseOffering->class->name }}

                                            </td>


                                            <td>

                                                {{ $meeting->schedule->courseOffering->lecturer->employee->name }}

                                            </td>


                                            <td>

                                                Pertemuan
                                                {{ $meeting->meeting_number }}

                                            </td>


                                            <td>

                                                {{ $meeting->meeting_date
                            ? \Carbon\Carbon::parse($meeting->meeting_date)->format('d-m-Y')
                            : '-'
                                                    }}

                                            </td>


                                            <td>

                                                @if($meeting->status == 'Selesai')

                                                    <span class="badge bg-success">
                                                        Selesai
                                                    </span>

                                                @else

                                                    <span class="badge bg-secondary">
                                                        Terjadwal
                                                    </span>

                                                @endif

                                            </td>


                                            <td>

                                                <div class="btn-group">


                                                    <a href="{{ route('meeting.show', $meeting->id) }}" class="btn btn-info btn-sm">

                                                        <i class="bi bi-eye"></i>

                                                    </a>


                                                    <a href="{{ route('meeting.edit', $meeting->id) }}" class="btn btn-warning btn-sm">

                                                        <i class="bi bi-pencil"></i>

                                                    </a>


                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        data-url="{{ route('meeting.destroy', $meeting->id) }}">

                                                        <i class="bi bi-trash"></i>

                                                    </button>


                                                </div>

                                            </td>


                                        </tr>


                        @empty

                            <tr>

                                <td colspan="8" class="text-center text-muted">

                                    Data tidak ditemukan

                                </td>

                            </tr>

                        @endforelse


                    </tbody>

                </table>

            </div>


            <div class="mt-3">

                {{ $meetings->withQueryString()->links() }}

            </div>


        </div>

    </div>


    <x-delete-modal />

@endsection
