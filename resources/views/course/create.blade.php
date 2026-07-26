@extends('layouts.app')

@section('title', 'Add Course')
@section('page-title', 'Add Course')

@section('content')

    <x-alert />

    <x-page-header title="Add Course" subtitle="Master Data" />

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form action="{{ route('course.store') }}" method="POST">

                @csrf

                @include('course._form')

            </form>

        </div>

    </div>

@endsection
