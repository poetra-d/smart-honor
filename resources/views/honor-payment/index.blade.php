@extends('layouts.app')

@section('title', 'Honor Payment')
@section('page-title', 'Honor Payment')

@section('content')

<x-alert />

<x-page-header title="Honor Payment" subtitle="Finance">
    <div class="d-flex gap-2">
        <div class="btn-group">
            <a href="{{ route('honor-payment.export.summary', request()->query()) }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel me-1"></i> Export Summary
            </a>
            <a href="{{ route('honor-payment.export.detail', request()->query()) }}" class="btn btn-outline-success">
                <i class="bi bi-file-earmark-excel me-1"></i> Export Detail
            </a>
        </div>
        <a href="{{ route('honor-payment.generate.form') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Generate Payment
        </a>
    </div>
</x-page-header>

{{-- SUMMARY --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary rounded p-3 me-3">
                    <i class="bi bi-receipt fs-4"></i>
                </div>
                <div>
                    <small class="text-muted fw-bold d-block mb-1">Total Payment</small>
                    <h3 class="mb-0 fw-bold">{{ $summary->total_payment ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 text-warning rounded p-3 me-3">
                    <i class="bi bi-file-earmark-text fs-4"></i>
                </div>
                <div>
                    <small class="text-muted fw-bold d-block mb-1">Draft</small>
                    <h3 class="mb-0 fw-bold text-warning">{{ $summary->total_draft ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="bg-success bg-opacity-10 text-success rounded p-3 me-3">
                    <i class="bi bi-check-circle fs-4"></i>
                </div>
                <div>
                    <small class="text-muted fw-bold d-block mb-1">Paid</small>
                    <h3 class="mb-0 fw-bold text-success">{{ $summary->total_paid ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="bg-info bg-opacity-10 text-info rounded p-3 me-3">
                    <i class="bi bi-wallet2 fs-4"></i>
                </div>
                <div>
                    <small class="text-muted fw-bold d-block mb-1">Total Honor</small>
                    <h5 class="mb-0 fw-bold">Rp {{ number_format($summary->total_honor ?? 0, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- FILTER --}}
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('honor-payment.index') }}">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Month</label>
                    <select name="month" class="form-select">
                        <option value="">All Months</option>
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}" @selected(request('month') == $month)>
                                {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Year</label>
                    <input type="number" name="year" class="form-control" placeholder="e.g., {{ date('Y') }}" value="{{ request('year') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="{{ \App\Models\HonorPayment::STATUS_DRAFT }}" @selected(request('status') == \App\Models\HonorPayment::STATUS_DRAFT)>
                            Draft
                        </option>
                        <option value="{{ \App\Models\HonorPayment::STATUS_PAID }}" @selected(request('status') == \App\Models\HonorPayment::STATUS_PAID)>
                            Paid
                        </option>
                        <option value="{{ \App\Models\HonorPayment::STATUS_CANCELLED }}" @selected(request('status') == \App\Models\HonorPayment::STATUS_CANCELLED)>
                            Cancelled
                        </option>
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i> Search
                    </button>
                    <a href="{{ route('honor-payment.index') }}" class="btn btn-light border w-100">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- TABLE --}}
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="60" class="text-center py-3">No</th>
                        <th class="py-3">Lecturer</th>
                        <th class="py-3">Period</th>
                        <th class="py-3">Generated At</th>
                        <th class="text-end py-3">Total</th>
                        <th class="py-3 text-center">Status</th>
                        <th width="100" class="text-center py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $index => $payment)
                        <tr>
                            <td class="text-center">{{ $payments->firstItem() + $index }}</td>
                            <td class="fw-medium text-dark">{{ $payment->lecturer?->employee?->name ?? '-' }}</td>
                            <td>
                                {{ \Carbon\Carbon::create()->month((int)$payment->month)->translatedFormat('F') }}
                                {{ $payment->year }}
                            </td>
                            <td>
                                {{ $payment->generated_at ? $payment->generated_at->format('d M Y, H:i') : '-' }}
                            </td>
                            <td class="text-end fw-semibold text-nowrap">
                                Rp {{ number_format($payment->total, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                @switch($payment->status)
                                    @case(\App\Models\HonorPayment::STATUS_DRAFT)
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Draft</span>
                                        @break
                                    @case(\App\Models\HonorPayment::STATUS_PAID)
                                        <span class="badge bg-success px-3 py-2 rounded-pill">Paid</span>
                                        @break
                                    @case(\App\Models\HonorPayment::STATUS_CANCELLED)
                                        <span class="badge bg-danger px-3 py-2 rounded-pill">Cancelled</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary px-3 py-2 rounded-pill">{{ $payment->status }}</span>
                                @endswitch
                            </td>
                            <td class="text-center">
                                <a href="{{ route('honor-payment.show', $payment) }}" class="btn btn-info btn-sm text-white" data-bs-toggle="tooltip" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                                No payment data available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($payments->hasPages())
        <div class="card-footer bg-white border-top py-3">
            {{ $payments->links() }}
        </div>
    @endif
</div>

@endsection
