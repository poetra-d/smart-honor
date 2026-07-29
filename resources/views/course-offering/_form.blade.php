<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">
                        Academic Year
                        <span class="text-danger">*</span>
                    </label>

                    <select name="academic_year_id" class="form-select @error('academic_year_id') is-invalid @enderror"
                        required>

                        <option value="">
                            -- Select Academic Year --
                        </option>

                        @foreach ($academicYears as $academicYear)

                            <option value="{{ $academicYear->id }}" @selected(old('academic_year_id', $courseOffering->academic_year_id ?? '') == $academicYear->id)>

                                {{ $academicYear->name }}

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

            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">
                        Semester
                        <span class="text-danger">*</span>
                    </label>

                    <select name="semester_id" class="form-select @error('semester_id') is-invalid @enderror" required>

                        <option value="">
                            -- Select Semester --
                        </option>

                        @foreach ($semesters as $semester)

                            <option value="{{ $semester->id }}" @selected(old('semester_id', $courseOffering->semester_id ?? '') == $semester->id)>

                                {{ $semester->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('semester_id')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">
                        Course
                        <span class="text-danger">*</span>
                    </label>

                    <select name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>

                        <option value="">
                            -- Select Course --
                        </option>

                        @foreach ($courses as $course)

                            <option value="{{ $course->id }}" @selected(old('course_id', $courseOffering->course_id ?? '') == $course->id)>

                                {{ $course->code }} - {{ $course->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('course_id')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">
                        Class
                        <span class="text-danger">*</span>
                    </label>

                    <select name="class_id" class="form-select @error('class_id') is-invalid @enderror" required>

                        <option value="">
                            -- Select Class --
                        </option>

                        @foreach ($classes as $class)

                            <option value="{{ $class->id }}" @selected(old('class_id', $courseOffering->class_id ?? '') == $class->id)>

                                {{ $class->code }} - {{ $class->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('class_id')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">
                        Lecturer
                        <span class="text-danger">*</span>
                    </label>

                    <select name="lecturer_id" class="form-select @error('lecturer_id') is-invalid @enderror" required>

                        <option value="">
                            -- Select Lecturer --
                        </option>

                        @foreach ($lecturers as $lecturer)

                            <option value="{{ $lecturer->id }}" @selected(old('lecturer_id', $courseOffering->lecturer_id ?? '') == $lecturer->id)>

                                {{ $lecturer->employee?->nip }}
                                -
                                {{ $lecturer->employee?->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('lecturer_id')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">
                        Quota
                        <span class="text-danger">*</span>
                    </label>

                    <input type="number" min="1" name="quota" class="form-control @error('quota') is-invalid @enderror"
                        value="{{ old('quota', $courseOffering->quota ?? '') }}" required>

                    @error('quota')

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

            <a href="{{ route('course-offering.index') }}" class="btn btn-secondary">

                Back

            </a>

        </div>

    </div>

</div>
