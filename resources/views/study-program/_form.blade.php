<div class="row">

    <div class="col-md-6">

        <div class="mb-3">

            <label class="form-label">

                Faculty

            </label>

            <select name="faculty_id" class="form-select @error('faculty_id') is-invalid @enderror" required>

                <option value="">

                    -- Select Faculty --

                </option>

                @foreach ($faculties as $faculty)
                    <option value="{{ $faculty->id }}" @selected(old('faculty_id', $studyProgram->faculty_id ?? '') == $faculty->id)>

                        {{ $faculty->code }} - {{ $faculty->name }}

                    </option>
                @endforeach

            </select>

            @error('faculty_id')
                <div class="invalid-feedback">

                    {{ $message }}

                </div>
            @enderror

        </div>

    </div>

    <div class="col-md-3">

        <div class="mb-3">

            <label class="form-label">

                Code

            </label>

            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                value="{{ old('code', $studyProgram->code ?? '') }}" required>

            @error('code')
                <div class="invalid-feedback">

                    {{ $message }}

                </div>
            @enderror

        </div>

    </div>

    <div class="col-md-3">

        <div class="mb-3">

            <label class="form-label">

                Name

            </label>

            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $studyProgram->name ?? '') }}" required>

            @error('name')
                <div class="invalid-feedback">

                    {{ $message }}

                </div>
            @enderror

        </div>

    </div>

</div>

<div class="mt-4">

    <button type="submit" class="btn btn-primary">

        <i class="bi bi-check-lg"></i>

        Save

    </button>

    <a href="{{ route('study-program.index') }}" class="btn btn-secondary">

        Back

    </a>

</div>
