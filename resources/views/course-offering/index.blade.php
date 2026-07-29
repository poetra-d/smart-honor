@extends('layouts.app')

@section('title', 'Course Offering')
@section('page-title', 'Course Offering')

@section('content')

    <x-alert />

    <x-page-header title="Course Offering" subtitle="Academic">

        <a href="{{ route('course-offering.create') }}" class="btn btn-primary">

            <i class="bi bi-plus-lg"></i>
            Add Data

        </a>

    </x-page-header>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form method="GET" action="{{ route('course-offering.index') }}">

                <div class="row mb-3">

                    <div class="col-md-3">

                        <select name="academic_year_id" class="form-select">

                            <option value="">
                                All Academic Year
                            </option>

                            @foreach($academicYears as $academicYear)

                                <option value="{{ $academicYear->id }}"
                                    @selected(request('academic_year_id') == $academicYear->id)>

                                    {{ $academicYear->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-2">

                        <select name="semester_id" class="form-select">

                            <option value="">
                                All Semester
                            </option>

                            @foreach($semesters as $semester)

                                <option value="{{ $semester->id }}" @selected(request('semester_id') == $semester->id)>

                                    {{ $semester->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-4">

                        <input type="text" name="search" class="form-control" placeholder="Search course or lecturer..."
                            value="{{ request('search') }}">

                    </div>

                    <div class="col-md-2">

                        <button type="submit" class="btn btn-secondary">

                            Search

                        </button>

                    </div>

                </div>

            </form>

            <div class="table-responsive">

                <table class="table table-striped table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="70">

                                No

                            </th>

                            <th>

                                Academic Year

                            </th>

                            <th>

                                Semester

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

                            <th width="90">

                                Quota

                            </th>

                            <th width="150" class="text-center">

                                Action

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($courseOfferings as $index => $item)

                            <tr>

                                <td>

                                    {{ $courseOfferings->firstItem() + $index }}

                                </td>

                                <td>

                                    {{ $item->academicYear?->name }}

                                </td>

                                <td>

                                    {{ $item->semester?->name }}

                                </td>

                                <td>

                                    {{ $item->course?->code }}
                                    -
                                    {{ $item->course?->name }}

                                </td>

                                <td>

                                    {{ $item->class?->name }}

                                </td>

                                <td>

                                    {{ $item->lecturer?->employee?->name }}

                                </td>

                                <td>

                                    {{ $item->quota }}

                                </td>

                                <td class="text-center">

                                    <div class="btn-group">

                                        <a href="{{ route('course-offering.show', $item->id) }}" class="btn btn-info btn-sm">

                                            <i class="bi bi-eye"></i>

                                        </a>

                                        <a href="{{ route('course-offering.edit', $item->id) }}" class="btn btn-warning btn-sm">

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-url="{{ route('course-offering.destroy', $item->id) }}">

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

                {{ $courseOfferings->withQueryString()->links() }}

            </div>

        </div>

    </div>

    <x-delete-modal />

@endsection
