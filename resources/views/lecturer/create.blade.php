@extends('layouts.app')

@section('title', 'Add Lecturer')
@section('page-title', 'Add Lecturer')

@section('content')

    <x-alert />

    <x-page-header
        title="Add Lecturer"
        subtitle="Master Data" />

    <form
        action="{{ route('lecturer.store') }}"
        method="POST">

        @csrf

        @include('lecturer._form')

    </form>

@endsection
