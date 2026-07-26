@extends('layouts.app')

@section('title', 'Edit Employee')
@section('page-title', 'Edit Employee')

@section('content')

    <x-alert />

    <x-page-header title="Edit Employee" subtitle="Master Data" />

    <form action="{{ route('employee.update', $employee->id) }}" method="POST">

        @csrf
        @method('PUT')

        @include('employee._form')

    </form>

@endsection
