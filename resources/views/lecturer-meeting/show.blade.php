@extends('layouts.app')

@section('title', 'Meeting Detail')
@section('page-title', 'Meeting Detail')


@section('content')

    <x-alert />


    <x-page-header title="Meeting Detail" subtitle="Teaching" />


    <div class="card shadow-sm border-0">

        <div class="card-body">


            <table class="table table-borderless">

                <tr>
                    <th width="200">
                        Course
                    </th>

                    <td>
                        {{ $meeting->schedule?->courseOffering?->course?->code }}
                        -
                        {{ $meeting->schedule?->courseOffering?->course?->name }}
                    </td>
                </tr>


                <tr>
                    <th>
                        Class
                    </th>

                    <td>
                        {{ $meeting->schedule?->courseOffering?->class?->name }}
                    </td>
                </tr>


                <tr>
                    <th>
                        Meeting
                    </th>

                    <td>
                        Pertemuan {{ $meeting->meeting_number }}
                    </td>
                </tr>


                <tr>
                    <th>
                        Schedule
                    </th>

                    <td>
                        {{ $meeting->schedule?->day }},
                        {{ $meeting->schedule?->start_time }}
                        -
                        {{ $meeting->schedule?->end_time }}
                    </td>
                </tr>


                <tr>
                    <th>
                        Room
                    </th>

                    <td>
                        {{ $meeting->schedule?->room?->room_name }}
                    </td>
                </tr>


                <tr>
                    <th>
                        Meeting Date
                    </th>

                    <td>
                        {{ $meeting->meeting_date
        ? \Carbon\Carbon::parse($meeting->meeting_date)->format('d-m-Y')
        : '-'
                        }}
                    </td>
                </tr>


                <tr>
                    <th>
                        Topic
                    </th>

                    <td>
                        {{ $meeting->topic ?? '-' }}
                    </td>
                </tr>


                <tr>
                    <th>
                        Description
                    </th>

                    <td>
                        {{ $meeting->description ?? '-' }}
                    </td>
                </tr>


                <tr>
                    <th>
                        Status
                    </th>

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
                </tr>


            </table>


            <a href="{{ route('my-meeting.index') }}" class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>


            @if($meeting->status != 'Selesai')

                <a href="{{ route('my-meeting.edit', $meeting->id) }}" class="btn btn-warning">

                    <i class="bi bi-pencil"></i>

                    Isi Pertemuan

                </a>

            @endif


        </div>

    </div>


@endsection
