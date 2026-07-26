@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')


@section('content')


<div class="row mb-4">

    <div class="col-md-12">

        <div class="card border-0 shadow-sm">

            <div class="card-body">


                <h3 class="mb-1">

                    Selamat Datang,
                    {{ auth()->user()->employee->name }}

                </h3>


                <p class="text-muted mb-0">

                    Role :
                    <strong>
                        {{ auth()->user()->getRoleNames()->first() }}
                    </strong>

                </p>


            </div>

        </div>

    </div>

</div>



@if($type == 'admin')

    @include('dashboard.admin')


@elseif($type == 'finance')

    @include('dashboard.finance')


@elseif($type == 'lecturer')

    @include('dashboard.lecturer')


@endif



@endsection
