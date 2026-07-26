@extends('layouts.app')

@section('title', 'Edit Schedule')
@section('page-title', 'Edit Schedule')

@section('content')

    <x-alert />

    <x-page-header title="Edit Schedule" subtitle="Teaching" />

    <form action="{{ route('schedule.update', $schedule->id) }}" method="POST">

        @csrf
        @method('PUT')

        @include('schedule._form')

    </form>

@endsection
