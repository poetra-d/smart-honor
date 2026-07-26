{{-- ================= MASTER DATA ================= --}}

<li class="mt-4 mb-2 text-uppercase fw-semibold text-secondary small">
    Master Data
</li>

<li>

    <a class="nav-link text-white" data-bs-toggle="collapse" href="#masterMenu">

        <i class="bi bi-database me-2"></i>

        Master Data

        <i class="bi bi-chevron-down float-end"></i>

    </a>

    <div class="collapse show" id="masterMenu">

        <ul class="nav flex-column ms-3">

            <li>
                <a href="{{ route('employee.index') }}"
                    class="nav-link {{ request()->routeIs('employee.*') ? 'active' : 'text-white' }}">
                    <i class="bi bi-person-badge me-2"></i>
                    Employee
                </a>
            </li>

            <li>
                <a href="{{ route('lecturer.index') }}"
                    class="nav-link {{ request()->routeIs('lecturer.*') ? 'active' : 'text-white' }}">
                    <i class="bi bi-mortarboard me-2"></i>
                    Lecturer
                </a>
            </li>

            <li>
                <a href="{{ route('employment-status.index') }}"
                    class="nav-link {{ request()->routeIs('employment-status.*') ? 'active' : 'text-white' }}">
                    <i class="bi bi-person-workspace me-2"></i>
                    Employment Status
                </a>
            </li>

            <li>
                <a href="{{ route('faculty.index') }}"
                    class="nav-link {{ request()->routeIs('faculty.*') ? 'active' : 'text-white' }}">
                    <i class="bi bi-building me-2"></i>
                    Faculty
                </a>
            </li>

            <li>
                <a href="{{ route('study-program.index') }}"
                    class="nav-link {{ request()->routeIs('study-program.*') ? 'active' : 'text-white' }}">
                    <i class="bi bi-diagram-3 me-2"></i>
                    Study Program
                </a>
            </li>

            <li>
                <a href="{{ route('academic-year.index') }}"
                    class="nav-link {{ request()->routeIs('academic-year.*') ? 'active' : 'text-white' }}">
                    <i class="bi bi-calendar-event me-2"></i>
                    Academic Year
                </a>
            </li>

            <li>
                <a href="{{ route('semester.index') }}"
                    class="nav-link {{ request()->routeIs('semester.*') ? 'active' : 'text-white' }}">
                    <i class="bi bi-clock-history me-2"></i>
                    Semester
                </a>
            </li>

            <li>
                <a href="{{ route('course.index') }}"
                    class="nav-link {{ request()->routeIs('course.*') ? 'active' : 'text-white' }}">
                    <i class="bi bi-book me-2"></i>
                    Course
                </a>
            </li>

            <li>
                <a href="{{ route('room.index') }}"
                    class="nav-link {{ request()->routeIs('room.*') ? 'active' : 'text-white' }}">
                    <i class="bi bi-door-open me-2"></i>
                    Room
                </a>
            </li>

            <li>
                <a href="{{ route('classroom.index') }}"
                    class="nav-link {{ request()->routeIs('classroom.*') ? 'active' : 'text-white' }}">
                    <i class="bi bi-house-door me-2"></i>
                    Classroom
                </a>
            </li>

            {{-- <li>
                <a href="{{ route('honor-rate.index') }}"
                    class="nav-link {{ request()->routeIs('honor-rate.*') ? 'active' : 'text-white' }}">
                    <i class="bi bi-cash-coin me-2"></i>
                    Honor Rate
                </a>
            </li> --}}

        </ul>

    </div>

</li>

{{-- ================= AKADEMIK ================= --}}

<li class="mt-4 mb-2 text-uppercase fw-semibold text-secondary small">
    Akademik
</li>

<li>

    <a class="nav-link text-white" data-bs-toggle="collapse" href="#academicMenu">

        <i class="bi bi-journal-text me-2"></i>

        Akademik

        <i class="bi bi-chevron-down float-end"></i>

    </a>


    <div class="collapse show" id="academicMenu">

        <ul class="nav flex-column ms-3">


            <li>
                <a href="{{ route('course-offering.index') }}"
                    class="nav-link {{ request()->routeIs('course-offering.*') ? 'active' : 'text-white' }}">

                    <i class="bi bi-journal-bookmark me-2"></i>

                    Course Offering

                </a>
            </li>


            <li>
                <a href="{{ route('schedule.index') }}"
                    class="nav-link {{ request()->routeIs('schedule.*') ? 'active' : 'text-white' }}">

                    <i class="bi bi-calendar-week me-2"></i>

                    Schedule

                </a>
            </li>


            <li>
                <a href="{{ route('meeting.index') }}"
                    class="nav-link {{ request()->routeIs('meeting.*') ? 'active' : 'text-white' }}">

                    <i class="bi bi-calendar-check me-2"></i>

                    Meeting

                </a>
            </li>


        </ul>

    </div>

</li>
