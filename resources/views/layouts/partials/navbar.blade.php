<nav class="navbar navbar-expand-lg topbar">

    <div class="container-fluid">

        <h5 class="mb-0">

            @yield('page-title', 'Dashboard')

        </h5>

        <div class="dropdown">

            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                <i class="bi bi-person-circle me-1"></i>

                {{ auth()->user()->employee->name }}

            </button>

            <ul class="dropdown-menu dropdown-menu-end">

                <li>

                    <span class="dropdown-item-text">

                        {{ auth()->user()->getRoleNames()->first() }}

                    </span>

                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>

                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button type="submit" class="dropdown-item">

                            <i class="bi bi-box-arrow-right me-2"></i>

                            Logout

                        </button>

                    </form>

                </li>

            </ul>

        </div>

    </div>

</nav>
