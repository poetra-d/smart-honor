@extends('layouts.app')

@section('title', 'Edit Lecturer')
@section('page-title', 'Edit Lecturer')

@section('content')

    <x-alert />

    <x-page-header
        title="Edit Lecturer"
        subtitle="Master Data" />

    <form
        action="{{ route('lecturer.update', $lecturer->id) }}"
        method="POST">

        @csrf
        @method('PUT')

        @include('lecturer._form')

    </form>

@endsection
