@extends('layouts.app')

@section('title', 'Edit Semester')
@section('page-title', 'Edit Semester')

@section('content')

    <x-alert />

    <x-page-header title="Edit Semester" subtitle="Master Data" />

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form action="{{ route('semester.update', $semester->id) }}" method="POST">

                @csrf
                @method('PUT')

                @include('semester._form')

            </form>

        </div>

    </div>

@endsection
