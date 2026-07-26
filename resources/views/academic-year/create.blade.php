@extends('layouts.app')

@section('title', 'Add Academic Year')
@section('page-title', 'Add Academic Year')

@section('content')

    <x-alert />

    <x-page-header title="Add Academic Year" subtitle="Master Data" />

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form action="{{ route('academic-year.store') }}" method="POST">

                @csrf

                @include('academic-year._form')

            </form>

        </div>

    </div>

@endsection
