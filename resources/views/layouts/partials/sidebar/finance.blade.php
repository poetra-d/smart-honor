{{-- ================= KEUANGAN ================= --}}

<li class="mt-4 mb-2 text-uppercase fw-semibold text-secondary small">
    Keuangan
</li>

<li>

    <a class="nav-link text-white" data-bs-toggle="collapse" href="#financeMenu" role="button" aria-expanded="true"
        aria-controls="financeMenu">

        <i class="bi bi-cash-stack me-2"></i>

        Keuangan

        <i class="bi bi-chevron-down float-end"></i>

    </a>

    <div class="collapse show" id="financeMenu">

        <ul class="nav flex-column ms-3">

            <li>

                <a href="{{ route('honor-rate.index') }}"
                    class="nav-link {{ request()->routeIs('honor-rate.*') ? 'active' : 'text-white' }}">

                    <i class="bi bi-cash-coin me-2"></i>

                    Honor Rate

                </a>

            </li>

            <li>

                <a href="{{ route('honor-payment.index') }}"
                    class="nav-link {{ request()->routeIs('honor-payment.*') ? 'active' : 'text-white' }}">

                    <i class="bi bi-wallet2 me-2"></i>

                    Honor Payment

                </a>

            </li>

        </ul>

    </div>

</li>
