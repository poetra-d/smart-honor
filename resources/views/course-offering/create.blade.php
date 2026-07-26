@extends('layouts.app')

@section('title', 'Add Course Offering')
@section('page-title', 'Add Course Offering')

@section('content')

    <x-alert />

    <x-page-header title="Add Course Offering" subtitle="Academic" />

    <form action="{{ route('course-offering.store') }}" method="POST">

        @csrf

        @include('course-offering._form')

    </form>

@endsection
