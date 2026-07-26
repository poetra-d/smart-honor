@extends('layouts.app')

@section('title', 'Edit Course')
@section('page-title', 'Edit Course')

@section('content')

    <x-alert />

    <x-page-header title="Edit Course" subtitle="Master Data" />

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form action="{{ route('course.update', $course->id) }}" method="POST">

                @csrf
                @method('PUT')

                @include('course._form')

            </form>

        </div>

    </div>

@endsection
