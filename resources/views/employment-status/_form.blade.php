<div class="mb-3">

    <label class="form-label">

        Code

    </label>

    <input
        type="text"
        name="code"
        class="form-control"
        value="{{ old('code', $employmentStatus->code ?? '') }}"
        required>

</div>

<div class="mb-3">

    <label class="form-label">

        Name

    </label>

    <input
        type="text"
        name="name"
        class="form-control"
        value="{{ old('name', $employmentStatus->name ?? '') }}"
        required>

</div>
