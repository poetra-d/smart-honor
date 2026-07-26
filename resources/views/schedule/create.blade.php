@extends('layouts.app')

@section('title', 'Add Schedule')
@section('page-title', 'Add Schedule')

@section('content')

    <x-alert />

    <x-page-header title="Add Schedule" subtitle="Teaching" />

    <form action="{{ route('schedule.store') }}" method="POST">

        @csrf

        @include('schedule._form')

    </form>

@endsection
