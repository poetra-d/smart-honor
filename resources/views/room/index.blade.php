@extends('layouts.app')

@section('title', 'Room')
@section('page-title', 'Room')

@section('content')

    <x-alert />

    <x-page-header title="Room" subtitle="Master Data">

        <a href="{{ route('room.create') }}" class="btn btn-primary">

            <i class="bi bi-plus-lg"></i>
            Add Data

        </a>

    </x-page-header>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form method="GET" action="{{ route('room.index') }}">

                <div class="row mb-3">

                    <div class="col-md-4">

                        <input type="text" name="search" class="form-control" placeholder="Search room name or building name..."
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

                            <th width="180">

                                Nama Ruangan

                            </th>

                            <th>

                                Nama Gedung

                            </th>

                            <th width="120">

                                Capacity

                            </th>

                            <th width="140" class="text-center">

                                Action

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($rooms as $index => $item)

                            <tr>

                                <td>

                                    {{ $rooms->firstItem() + $index }}

                                </td>

                                <td>

                                    {{ $item->room_name }}

                                </td>

                                <td>

                                    {{ $item->building_name }}

                                </td>

                                <td>

                                    {{ $item->capacity }}

                                </td>

                                <td class="text-center">

                                    <div class="btn-group">

                                        <a href="{{ route('room.edit', $item->id) }}" class="btn btn-warning btn-sm">

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-url="{{ route('room.destroy', $item->id) }}">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center text-muted py-4">

                                    Data tidak ditemukan

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $rooms->withQueryString()->links() }}

            </div>

        </div>

    </div>

    <x-delete-modal />

@endsection
