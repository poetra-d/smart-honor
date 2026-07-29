<div class="row">

    <div class="col-md-6">

        <div class="mb-3">

            <label class="form-label">

                Study Program <span class="text-danger">*</span>

            </label>

            <select name="study_program_id" class="form-select @error('study_program_id') is-invalid @enderror"
                required>

                <option value="">

                    -- Select Study Program --

                </option>

                @foreach ($studyPrograms as $studyProgram)

                    <option value="{{ $studyProgram->id }}" @selected(old('study_program_id', $classroom->study_program_id ?? '') == $studyProgram->id)>

                        {{ $studyProgram->faculty?->code }} - {{ $studyProgram->name }}

                    </option>

                @endforeach

            </select>

            @error('study_program_id')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </div>

    <div class="col-md-6">

        <div class="mb-3">

            <label class="form-label">

                Academic Year <span class="text-danger">*</span>

            </label>

            <select name="academic_year_id" class="form-select @error('academic_year_id') is-invalid @enderror"
                required>

                <option value="">

                    -- Select Academic Year --

                </option>

                @foreach ($academicYears as $academicYear)

                    <option value="{{ $academicYear->id }}" @selected(old('academic_year_id', $classroom->academic_year_id ?? '') == $academicYear->id)>

                        {{ $academicYear->code }}

                    </option>

                @endforeach

            </select>

            @error('academic_year_id')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-2">

        <div class="mb-3">

            <label class="form-label">

                Code <span class="text-danger">*</span>

            </label>

            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                value="{{ old('code', $classroom->code ?? '') }}" required>

            @error('code')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </div>

    <div class="col-md-5">

        <div class="mb-3">

            <label class="form-label">

                Name <span class="text-danger">*</span>

            </label>

            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $classroom->name ?? '') }}" required>

            @error('name')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </div>

    <div class="col-md-2">

        <div class="mb-3">

            <label class="form-label">

                Quota <span class="text-danger">*</span>

            </label>

            <input type="number" name="quota" class="form-control @error('quota') is-invalid @enderror"
                value="{{ old('quota', $classroom->quota ?? '') }}" min="1" required>

            @error('quota')

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

                <option value="1" @selected(old('is_active', $classroom->is_active ?? 1) == 1)>

                    Active

                </option>

                <option value="0" @selected(old('is_active', $classroom->is_active ?? 1) == 0)>

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

    <a href="{{ route('classroom.index') }}" class="btn btn-secondary">

        Back

    </a>

</div>
