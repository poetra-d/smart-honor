@extends('layouts.app')

@section('title', 'Edit Faculty')
@section('page-title', 'Edit Faculty')

@section('content')

    <div class="card shadow-sm border-0">

        <div class="card-header">

            <strong>
                Edit Faculty
            </strong>

        </div>

        <div class="card-body">

            <form action="{{ route('faculty.update', $faculty->id) }}" method="POST">

                @csrf
                @method('PUT')

                @include('faculty._form')

                <div class="mt-4">

                    <button class="btn btn-primary">

                        <i class="bi bi-check-lg"></i>

                        Update

                    </button>

                    <a href="{{ route('faculty.index') }}" class="btn btn-secondary">

                        Back

                    </a>

                </div>

            </form>

        </div>

    </div>

@endsection
