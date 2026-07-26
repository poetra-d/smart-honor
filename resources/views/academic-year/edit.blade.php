@extends('layouts.app')

@section('title', 'Edit Academic Year')
@section('page-title', 'Edit Academic Year')

@section('content')

    <x-alert />

    <x-page-header title="Edit Academic Year" subtitle="Master Data" />

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form action="{{ route('academic-year.update', $academicYear->id) }}" method="POST">

                @csrf
                @method('PUT')

                @include('academic-year._form')

            </form>

        </div>

    </div>

@endsection
