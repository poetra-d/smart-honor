{{-- ================= TEACHING ================= --}}

<li class="mt-4 mb-2 text-uppercase fw-semibold text-secondary small">
    Teaching
</li>


<li>

    <a class="nav-link text-white" data-bs-toggle="collapse" href="#teachingMenu">

        <i class="bi bi-journal-text me-2"></i>

        Teaching

        <i class="bi bi-chevron-down float-end"></i>

    </a>


    <div class="collapse show" id="teachingMenu">

        <ul class="nav flex-column ms-3">


            <li>

                <a href="{{ route('my-meeting.index') }}"
                    class="nav-link {{ request()->routeIs('my-meeting.*') ? 'active' : 'text-white' }}">

                    <i class="bi bi-calendar-check me-2"></i>

                    My Meeting

                </a>

            </li>

            <li>
                <a href="{{ route('my-honor.index') }}"
                    class="nav-link {{ request()->routeIs('my-honor.*') ? 'active' : 'text-white' }}">

                    <i class="bi bi-cash-stack me-2"></i>

                    My Honor

                </a>
            </li>


        </ul>

    </div>

</li>
