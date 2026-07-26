<div class="mb-3">

    <label class="form-label">
        Code
    </label>

    <input
        type="text"
        name="code"
        class="form-control @error('code') is-invalid @enderror"
        value="{{ old('code', $faculty->code ?? '') }}"
        required>

    @error('code')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>

<div class="mb-3">

    <label class="form-label">
        Name
    </label>

    <input
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $faculty->name ?? '') }}"
        required>

    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>
