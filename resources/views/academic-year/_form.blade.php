<div class="row">

    <div class="col-md-3">

        <div class="mb-3">

            <label class="form-label">

                Code <span class="text-danger">*</span>

            </label>

            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                value="{{ old('code', $academicYear->code ?? '') }}" required>

            @error('code')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </div>

    <div class="col-md-6">

        <div class="mb-3">

            <label class="form-label">

                Name <span class="text-danger">*</span>

            </label>

            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $academicYear->name ?? '') }}" required>

            @error('name')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </div>

    <div class="col-md-3">

        <div class="mb-3">

            <label class="form-label">

                Active

            </label>

            <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">

                <option value="1" @selected(old('is_active', $academicYear->is_active ?? 1) == 1)>

                    Active

                </option>

                <option value="0" @selected(old('is_active', $academicYear->is_active ?? 1) == 0)>

                    Inactive

                </option>

            </select>

            @error('is_active')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </div>

</div>

<div class="mt-3">

    <button type="submit" class="btn btn-primary">

        <i class="bi bi-check-lg"></i>

        Save

    </button>

    <a href="{{ route('academic-year.index') }}" class="btn btn-secondary">

        Back

    </a>

</div>
