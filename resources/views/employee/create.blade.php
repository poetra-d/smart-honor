@extends('layouts.app')

@section('title', 'Add Employee')
@section('page-title', 'Add Employee')

@section('content')

    <x-alert />

    <x-page-header
        title="Add Employee"
        subtitle="Master Data" />

    <form
        action="{{ route('employee.store') }}"
        method="POST">

        @csrf

        @include('employee._form')

    </form>

@endsection
