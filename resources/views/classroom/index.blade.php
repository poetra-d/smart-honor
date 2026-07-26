@extends('layouts.app')

@section('title', 'Class')
@section('page-title', 'Class')

@section('content')

    <x-alert />

    <x-page-header title="Class" subtitle="Master Data">

        <a href="{{ route('classroom.create') }}" class="btn btn-primary">

            <i class="bi bi-plus-lg"></i>
            Add Data

        </a>

    </x-page-header>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form method="GET" action="{{ route('classroom.index') }}">

                <div class="row mb-3">

                    <div class="col-md-4">

                        <input type="text" name="search" class="form-control" placeholder="Search..."
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

                                Study Program

                            </th>

                            <th width="180">

                                Academic Year

                            </th>

                            <th width="100">

                                Code

                            </th>

                            <th>

                                Name

                            </th>

                            <th width="90">

                                Quota

                            </th>

                            <th width="100">

                                Active

                            </th>

                            <th width="140" class="text-center">

                                Action

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($classrooms as $index => $item)

                            <tr>

                                <td>

                                    {{ $classrooms->firstItem() + $index }}

                                </td>

                                <td>

                                    {{ $item->studyProgram->name }}

                                </td>

                                <td>

                                    {{ $item->academicYear->code }}

                                </td>

                                <td>

                                    {{ $item->code }}

                                </td>

                                <td>

                                    {{ $item->name }}

                                </td>

                                <td>

                                    {{ $item->quota }}

                                </td>

                                <td>

                                    @if ($item->is_active)

                                        <span class="badge bg-success">

                                            Active

                                        </span>

                                    @else

                                        <span class="badge bg-secondary">

                                            Inactive

                                        </span>

                                    @endif

                                </td>

                                <td class="text-center">

                                    <div class="btn-group">

                                        <a href="{{ route('classroom.edit', $item->id) }}" class="btn btn-warning btn-sm">

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-url="{{ route('classroom.destroy', $item->id) }}">

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

                {{ $classrooms->withQueryString()->links() }}

            </div>

        </div>

    </div>

    <x-delete-modal />

@endsection
