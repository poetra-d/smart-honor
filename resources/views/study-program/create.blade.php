@extends('layouts.app')

@section('title', 'Add Study Program')
@section('page-title', 'Add Study Program')

@section('content')

    <x-alert />

    <x-page-header title="Add Study Program" subtitle="Master Data" />

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form action="{{ route('study-program.store') }}" method="POST">

                @csrf

                @include('study-program._form')

            </form>

        </div>

    </div>

@endsection
