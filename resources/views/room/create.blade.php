@extends('layouts.app')

@section('title', 'Add Room')
@section('page-title', 'Add Room')

@section('content')

    <x-alert />

    <x-page-header title="Add Room" subtitle="Master Data" />

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form action="{{ route('room.store') }}" method="POST">

                @csrf

                @include('room._form')

            </form>

        </div>

    </div>

@endsection
