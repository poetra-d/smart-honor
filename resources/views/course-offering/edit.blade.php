@extends('layouts.app')

@section('title', 'Edit Course Offering')
@section('page-title', 'Edit Course Offering')

@section('content')

    <x-alert />

    <x-page-header title="Edit Course Offering" subtitle="Academic" />

    <form action="{{ route('course-offering.update', $courseOffering->id) }}" method="POST">

        @csrf
        @method('PUT')

        @include('course-offering._form')

    </form>

@endsection
