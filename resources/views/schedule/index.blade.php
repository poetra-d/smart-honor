@extends('layouts.app')

@section('title', 'Schedule')
@section('page-title', 'Schedule')

@section('content')

    <x-alert />

    <x-page-header title="Schedule" subtitle="Teaching">

        <a href="{{ route('schedule.create') }}" class="btn btn-primary">

            <i class="bi bi-plus-lg"></i>
            Add Data

        </a>

    </x-page-header>


    <div class="card shadow-sm border-0">

        <div class="card-body">


            <form method="GET" action="{{ route('schedule.index') }}">

                <div class="row mb-3">

                    <div class="col-md-4">

                        <input type="text" name="search" class="form-control" placeholder="Search course..."
                            value="{{ request('search') }}">

                    </div>


                    <div class="col-md-2">

                        <button class="btn btn-secondary" type="submit">

                            Search

                        </button>

                    </div>

                </div>

            </form>



            <div class="table-responsive">

                <table class="table table-striped table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="80">
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
                                Room
                            </th>

                            <th>
                                Day
                            </th>

                            <th>
                                Time
                            </th>

                            <th width="140" class="text-center">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($schedules as $index => $item)

                            <tr>

                                <td>
                                    {{ $schedules->firstItem() + $index }}
                                </td>


                                <td>

                                    {{ $item->courseOffering?->course?->code }}
                                    -
                                    {{ $item->courseOffering?->course?->name }}

                                </td>


                                <td>

                                    {{ $item->courseOffering?->class?->name }}

                                </td>


                                <td>

                                    {{ $item->courseOffering?->lecturer?->employee?->name }}

                                </td>


                                <td>

                                    {{ $item->room?->room_name }}

                                </td>


                                <td>

                                    {{ $item->day }}

                                </td>


                                <td>

                                    {{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}

                                </td>


                                <td class="text-center">

                                    <div class="btn-group">


                                        <a href="{{ route('schedule.show', $item->id) }}" class="btn btn-info btn-sm">

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        <a href="{{ route('schedule.edit', $item->id) }}" class="btn btn-warning btn-sm">

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-url="{{ route('schedule.destroy', $item->id) }}">

                                            <i class="bi bi-trash"></i>

                                        </button>


                                    </div>

                                </td>


                            </tr>


                        @empty

                            <tr>

                                <td colspan="8" class="text-center text-muted py-4">

                                    Data tidak ditemukan

                                </td>

                            </tr>

                        @endforelse


                    </tbody>


                </table>


            </div>


            <div class="mt-3">

                {{ $schedules->withQueryString()->links() }}

            </div>


        </div>

    </div>


    <x-delete-modal />


@endsection
