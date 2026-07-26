@extends('layouts.app')

@section('title', 'Add Honor Rate')
@section('page-title', 'Add Honor Rate')

@section('content')

    <x-alert />

    <x-page-header title="Add Honor Rate" subtitle="Finance" />

    <form action="{{ route('honor-rate.store') }}" method="POST">

        @csrf

        @include('honor-rate._form')

    </form>

@endsection
