<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="mb-1">

            {{ $title }}

        </h3>

        @isset($subtitle)
            <small class="text-muted">

                {{ $subtitle }}

            </small>
        @endisset

    </div>

    {{ $slot }}

</div>
