@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">

        <i class="bi bi-check-circle me-2"></i>

        {{ session('success') }}

        <button class="btn-close" data-bs-dismiss="alert"></button>

    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">

        <i class="bi bi-x-circle me-2"></i>

        {{ session('error') }}

        <button class="btn-close" data-bs-dismiss="alert"></button>

    </div>
@endif
