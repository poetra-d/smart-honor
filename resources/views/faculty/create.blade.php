@extends('layouts.app')

@section('title', 'Add Faculty')
@section('page-title', 'Add Faculty')

@section('content')

    <div class="card shadow-sm border-0">

        <div class="card-header">

            <strong>
                Add Faculty
            </strong>

        </div>

        <div class="card-body">

            <form action="{{ route('faculty.store') }}" method="POST">

                @csrf

                @include('faculty._form')

                <div class="mt-4">

                    <button class="btn btn-primary">

                        <i class="bi bi-check-lg"></i>

                        Save

                    </button>

                    <a href="{{ route('faculty.index') }}" class="btn btn-secondary">

                        Back

                    </a>

                </div>

            </form>

        </div>

    </div>

@endsection
