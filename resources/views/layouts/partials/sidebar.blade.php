<div class="sidebar d-flex flex-column p-3 text-bg-dark">

    <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-4 text-white text-decoration-none">

        <i class="bi bi-mortarboard-fill fs-3 me-2"></i>

        <span class="fs-4 fw-bold">
            Smart Honor
        </span>

    </a>


    <hr class="text-secondary">

    <ul class="nav nav-pills flex-column mb-auto">


        <li class="nav-item">

            <a href="{{ route('dashboard') }}"
                class="nav-link {{ request()->routeIs('dashboard') ? 'active' : 'text-white' }}">

                <i class="bi bi-speedometer2 me-2"></i>

                Dashboard

            </a>

        </li>

        @role('Admin Akademik')
        @include('layouts.partials.sidebar.admin')
        @endrole

        @role('Dosen')
        @include('layouts.partials.sidebar.lecturer')
        @endrole

        @role('Keuangan')
        @include('layouts.partials.sidebar.finance')
        @endrole

    </ul>

</div>
