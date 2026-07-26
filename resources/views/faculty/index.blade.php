@extends('layouts.app')

@section('title', 'Faculty')
@section('page-title', 'Faculty')

@section('content')

    <x-alert />

    {{-- Header Page --}}
    <x-page-header title="Faculty" subtitle="Master Data">
        <a href="{{ route('faculty.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
            Add Data
        </a>
    </x-page-header>

    {{-- Main Card --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">

            {{-- Search Form --}}
            <form method="GET" action="{{ route('faculty.index') }}">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search code or name..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-secondary" type="submit">
                            Search
                        </button>
                    </div>
                </div>
            </form>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="80">No</th>
                            <th width="200">Code</th>
                            <th>Name</th>
                            <th width="140" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($faculties as $index => $item)
                            <tr>
                                <td>{{ $faculties->firstItem() + $index }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        {{-- Edit Button --}}
                                        <a href="{{ route('faculty.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        {{-- Delete Button (Trigger Modal) --}}
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-url="{{ route('faculty.destroy', $item->id) }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Data tidak ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $faculties->withQueryString()->links() }}
            </div>

        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <x-delete-modal />

@endsection
