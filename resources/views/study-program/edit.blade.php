@extends('layouts.app')

@section('title', 'Edit Study Program')
@section('page-title', 'Edit Study Program')

@section('content')

    <x-alert />

    <x-page-header title="Edit Study Program" subtitle="Master Data" />

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form action="{{ route('study-program.update', $studyProgram->id) }}" method="POST">

                @csrf
                @method('PUT')

                @include('study-program._form')

            </form>

        </div>

    </div>

@endsection
