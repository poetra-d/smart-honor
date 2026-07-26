@extends('layouts.app')

@section('title', 'Edit Meeting')
@section('page-title', 'Edit Meeting')

@section('content')

    <x-alert />

    <x-page-header title="Edit Meeting" subtitle="Teaching" />


    <form action="{{ route('meeting.update', $meeting->id) }}" method="POST">

        @csrf
        @method('PUT')


        @include('meeting._form')


    </form>


@endsection
