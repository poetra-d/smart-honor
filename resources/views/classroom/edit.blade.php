@extends('layouts.app')

@section('title', 'Edit Class')
@section('page-title', 'Edit Class')

@section('content')

    <x-alert />

    <x-page-header title="Edit Class" subtitle="Master Data" />

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form action="{{ route('classroom.update', $classroom->id) }}" method="POST">

                @csrf
                @method('PUT')

                @include('classroom._form')

            </form>

        </div>

    </div>

@endsection
