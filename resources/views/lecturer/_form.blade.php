<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">

                        Employee <span class="text-danger">*</span>

                    </label>

                    <select name="employee_id" class="form-select @error('employee_id') is-invalid @enderror" required>

                        <option value="">

                            -- Select Employee --

                        </option>

                        @foreach ($employees as $employee)

                            <option value="{{ $employee->id }}" @selected(old('employee_id', $lecturer->employee_id ?? '') == $employee->id)>

                                {{ $employee->nip }} - {{ $employee->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('employee_id')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">

                        Employment Status
                        <span class="text-danger">*</span>

                    </label>

                    <select name="employment_status_id"
                        class="form-select @error('employment_status_id') is-invalid @enderror" required>

                        <option value="">
                            -- Select Employment Status --
                        </option>

                        @foreach($employmentStatuses as $status)

                            <option value="{{ $status->id }}" @selected(
                                old(
                                    'employment_status_id',
                                    $lecturer->employment_status_id ?? ''
                                ) == $status->id
                            )>

                                {{ $status->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('employment_status_id')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">

                        NIDN <span class="text-danger">*</span>

                    </label>

                    <input type="text" name="nidn" class="form-control @error('nidn') is-invalid @enderror"
                        value="{{ old('nidn', $lecturer->nidn ?? '') }}" required>

                    @error('nidn')

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

            <a href="{{ route('lecturer.index') }}" class="btn btn-secondary">

                Back

            </a>

        </div>

    </div>

</div>
