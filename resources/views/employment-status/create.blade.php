@extends('layouts.app')

@section('title', 'Add Employment Status')

@section('page-title', 'Add Employment Status')

@section('content')

    <div class="card shadow-sm border-0">

        <div class="card-header">

            <strong>

                Add Employment Status

            </strong>

        </div>

        <div class="card-body">

            <form action="{{ route('employment-status.store') }}" method="POST">

                @csrf

                @include('employment-status._form')

                <div class="mt-4">

                    <button class="btn btn-primary">

                        <i class="bi bi-check-lg"></i>

                        Save

                    </button>

                    <a href="{{ route('employment-status.index') }}" class="btn btn-secondary">

                        Back

                    </a>

                </div>

            </form>

        </div>

    </div>

@endsection
