@extends('layouts.app')

@section('title', 'Edit Honor Rate')
@section('page-title', 'Edit Honor Rate')

@section('content')

    <x-alert />

    <x-page-header title="Edit Honor Rate" subtitle="Finance" />

    <form action="{{ route('honor-rate.update', $honorRate->id) }}" method="POST">

        @csrf
        @method('PUT')

        @include('honor-rate._form')

    </form>

@endsection
