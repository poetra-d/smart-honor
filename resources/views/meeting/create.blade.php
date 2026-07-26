@extends('layouts.app')

@section('title', 'Add Meeting')
@section('page-title', 'Add Meeting')

@section('content')

    <x-alert />

    <x-page-header title="Add Meeting" subtitle="Teaching" />


    <form action="{{ route('meeting.store') }}" method="POST">

        @csrf

        @include('meeting._form')

    </form>


@endsection
