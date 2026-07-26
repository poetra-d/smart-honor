@extends('layouts.app')

@section('title', 'Add Class')
@section('page-title', 'Add Class')

@section('content')

    <x-alert />

    <x-page-header title="Add Class" subtitle="Master Data" />

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form action="{{ route('classroom.store') }}" method="POST">

                @csrf

                @include('classroom._form')

            </form>

        </div>

    </div>

@endsection
