@extends('layouts.app')

@section('title', 'Lecturer')
@section('page-title', 'Lecturer')

@section('content')

    <x-alert />

    <x-page-header title="Lecturer" subtitle="Master Data">

        <a href="{{ route('lecturer.create') }}" class="btn btn-primary">

            <i class="bi bi-plus-lg"></i>
            Add Data

        </a>

    </x-page-header>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form method="GET" action="{{ route('lecturer.index') }}">

                <div class="row mb-3">

                    <div class="col-md-4">

                        <input type="text" name="search" class="form-control" placeholder="Search NIDN, NIP or Name..."
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

                                NIDN

                            </th>

                            <th width="180">

                                NIP

                            </th>

                            <th>

                                Name

                            </th>

                            <th width="200">

                                Employment Status

                            </th>

                            <th width="180" class="text-center">

                                Action

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($lecturers as $index => $item)

                            <tr>

                                <td>

                                    {{ $lecturers->firstItem() + $index }}

                                </td>

                                <td>

                                    {{ $item->nidn }}

                                </td>

                                <td>

                                    {{ $item->employee->nip }}

                                </td>

                                <td>

                                    {{ $item->employee->name }}

                                </td>

                                <td>

                                    {{ $item->employmentStatus->name }}

                                </td>

                                <td class="text-center">

                                    <div class="btn-group">

                                        <a href="{{ route('lecturer.show', $item->id) }}" class="btn btn-info btn-sm">

                                            <i class="bi bi-eye"></i>

                                        </a>

                                        <a href="{{ route('lecturer.edit', $item->id) }}" class="btn btn-warning btn-sm">

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-url="{{ route('lecturer.destroy', $item->id) }}">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center text-muted py-4">

                                    Data tidak ditemukan

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $lecturers->withQueryString()->links() }}

            </div>

        </div>

    </div>

    <x-delete-modal />

@endsection
