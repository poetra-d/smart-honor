<!DOCTYPE html>
<html lang="en">

@include('layouts.partials.styles')

<body>

    @include('layouts.partials.sidebar')

    <div class="content">

        @include('layouts.partials.navbar')

        <div class="page-content">

            @yield('content')

        </div>

        @include('layouts.partials.footer')

    </div>

    @include('layouts.partials.scripts')

</body>

</html>
