@extends('layouts.app')

@section('title', 'Honor Rate')
@section('page-title', 'Honor Rate')

@section('content')

    <x-alert />

    <x-page-header title="Honor Rate" subtitle="Finance">

        <a href="{{ route('honor-rate.create') }}" class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>

            Add Honor Rate

        </a>

    </x-page-header>


    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th width="70">
                                No
                            </th>

                            <th>
                                Employment Status
                            </th>

                            <th>
                                Rate / SKS
                            </th>

                            <th>
                                Effective Date
                            </th>

                            <th width="170">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($honorRates as $index => $honorRate)

                            <tr>

                                <td>

                                    {{ $honorRates->firstItem() + $index }}

                                </td>

                                <td>

                                    {{ $honorRate->employmentStatus->name }}

                                </td>

                                <td>

                                    Rp {{ number_format($honorRate->rate_per_sks, 0, ',', '.') }}

                                </td>

                                <td>

                                    {{ \Carbon\Carbon::parse($honorRate->effective_date)->format('d F Y') }}

                                </td>

                                <td>

                                    <a href="{{ route('honor-rate.show', $honorRate->id) }}" class="btn btn-info btn-sm">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                    <a href="{{ route('honor-rate.edit', $honorRate->id) }}" class="btn btn-warning btn-sm">

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $honorRate->id }}">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                    <x-delete-modal :id="$honorRate->id" :action="route('honor-rate.destroy', $honorRate->id)"
                                        title="Delete Honor Rate" message="Are you sure you want to delete this honor rate?" />

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center text-muted">

                                    No data available.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        @if($honorRates->hasPages())

            <div class="card-footer">

                {{ $honorRates->links() }}

            </div>

        @endif

    </div>

@endsection
