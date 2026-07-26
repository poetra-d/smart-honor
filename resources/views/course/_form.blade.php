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

                    <option value="{{ $studyProgram->id }}" @selected(old('study_program_id', $course->study_program_id ?? '') == $studyProgram->id)>

                        {{ $studyProgram->faculty->code }} - {{ $studyProgram->name }}

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

    <div class="col-md-3">

        <div class="mb-3">

            <label class="form-label">

                Code <span class="text-danger">*</span>

            </label>

            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                value="{{ old('code', $course->code ?? '') }}" required>

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

                Credit Hour (SKS) <span class="text-danger">*</span>

            </label>

            <input type="number" name="sks" class="form-control @error('sks') is-invalid @enderror"
                value="{{ old('sks', $course->sks ?? '') }}" min="1" max="6" required>

            @error('sks')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-12">

        <div class="mb-3">

            <label class="form-label">

                Name <span class="text-danger">*</span>

            </label>

            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $course->name ?? '') }}" required>

            @error('name')

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

    <a href="{{ route('course.index') }}" class="btn btn-secondary">

        Back

    </a>

</div>
