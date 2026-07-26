@extends('layouts.app')

@section('title', 'Add Semester')
@section('page-title', 'Add Semester')

@section('content')

    <x-alert />

    <x-page-header title="Add Semester" subtitle="Master Data" />

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form action="{{ route('semester.store') }}" method="POST">

                @csrf

                @include('semester._form')

            </form>

        </div>

    </div>

@endsection
