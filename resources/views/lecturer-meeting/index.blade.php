@extends('layouts.app')

@section('title', 'My Meeting')
@section('page-title', 'My Meeting')

@section('content')

    <x-alert />

    <x-page-header title="My Meeting" subtitle="Teaching" />


    <div class="card shadow-sm border-0">

        <div class="card-body">


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
                                Meeting
                            </th>

                            <th>
                                Date
                            </th>

                            <th>
                                Topic
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="100">
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

                                                {{ $meeting->schedule?->courseOffering?->course?->code }}

                                                -

                                                {{ $meeting->schedule?->courseOffering?->course?->name }}

                                            </td>


                                            <td>

                                                {{ $meeting->schedule?->courseOffering?->class?->name }}

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

                                                {{ $meeting->topic ?? '-' }}

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

                                                <a href="{{ route('my-meeting.show', $meeting->id) }}"
                                                    class="btn btn-info btn-sm text-white">

                                                    <i class="bi bi-eye"></i>

                                                </a>


                                                @if($meeting->status != 'Selesai')

                                                    <a href="{{ route('my-meeting.edit', $meeting->id) }}" class="btn btn-warning btn-sm">

                                                        <i class="bi bi-pencil"></i>

                                                    </a>

                                                @endif

                                            </td>


                                        </tr>


                        @empty

                            <tr>

                                <td colspan="8" class="text-center text-muted">

                                    Belum ada meeting

                                </td>

                            </tr>

                        @endforelse


                    </tbody>


                </table>

            </div>


            <div class="mt-3">

                {{ $meetings->links() }}

            </div>


        </div>

    </div>


@endsection
