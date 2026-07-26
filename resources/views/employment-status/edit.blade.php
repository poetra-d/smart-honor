@extends('layouts.app')

@section('title', 'Edit Employment Status')

@section('page-title', 'Edit Employment Status')

@section('content')

    <div class="card shadow-sm border-0">

        <div class="card-header">

            <strong>

                Edit Employment Status

            </strong>

        </div>

        <div class="card-body">

            <form action="{{ route('employment-status.update', $employmentStatus->id) }}" method="POST">

                @csrf

                @method('PUT')

                @include('employment-status._form')

                <div class="mt-4">

                    <button class="btn btn-primary">

                        <i class="bi bi-check-lg"></i>

                        Update

                    </button>

                    <a href="{{ route('employment-status.index') }}" class="btn btn-secondary">

                        Back

                    </a>

                </div>

            </form>

        </div>

    </div>

@endsection
