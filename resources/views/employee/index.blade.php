@extends('layouts.app')

@section('title', 'Employee')
@section('page-title', 'Employee')

@section('content')

    <x-alert />

    <x-page-header title="Employee" subtitle="Master Data">

        <a href="{{ route('employee.create') }}" class="btn btn-primary">

            <i class="bi bi-plus-lg"></i>
            Add Data

        </a>

    </x-page-header>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form method="GET" action="{{ route('employee.index') }}">

                <div class="row mb-3">

                    <div class="col-md-4">

                        <input type="text" name="search" class="form-control" placeholder="Search username, NIP, name..."
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
                                Username
                            </th>

                            <th width="150">
                                NIP
                            </th>

                            <th>
                                Name
                            </th>

                            <th width="120">
                                Phone
                            </th>

                            <th width="180" class="text-center">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($employees as $index => $item)

                            <tr>

                                <td>

                                    {{ $employees->firstItem() + $index }}

                                </td>

                                <td>

                                    {{ $item->user->username }}

                                </td>

                                <td>

                                    {{ $item->nip }}

                                </td>

                                <td>

                                    {{ $item->name }}

                                </td>

                                <td>

                                    {{ $item->phone ?: '-' }}

                                </td>

                                <td class="text-center">

                                    <div class="btn-group">

                                        <a href="{{ route('employee.show', $item->id) }}" class="btn btn-info btn-sm">

                                            <i class="bi bi-eye"></i>

                                        </a>

                                        <a href="{{ route('employee.edit', $item->id) }}" class="btn btn-warning btn-sm">

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-url="{{ route('employee.destroy', $item->id) }}">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center text-muted py-4">

                                    Data tidak ditemukan

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $employees->withQueryString()->links() }}

            </div>

        </div>

    </div>

    <x-delete-modal />

@endsection
