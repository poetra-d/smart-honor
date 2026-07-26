<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="row">

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

                        @foreach($employmentStatuses as $employmentStatus)

                            <option value="{{ $employmentStatus->id }}" @selected(
                                old(
                                    'employment_status_id',
                                    $honorRate->employment_status_id ?? ''
                                ) == $employmentStatus->id
                            )>

                                {{ $employmentStatus->name }}

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
                        Effective Date
                        <span class="text-danger">*</span>
                    </label>

                    <input type="date" name="effective_date"
                        class="form-control @error('effective_date') is-invalid @enderror" value="{{ old(
    'effective_date',
    isset($honorRate)
    ? \Carbon\Carbon::parse($honorRate->effective_date)->format('Y-m-d')
    : ''
) }}" required>

                    @error('effective_date')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>


            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">
                        Rate per SKS
                        <span class="text-danger">*</span>
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            Rp
                        </span>

                        <input type="number" name="rate_per_sks"
                            class="form-control @error('rate_per_sks') is-invalid @enderror" value="{{ old(
    'rate_per_sks',
    $honorRate->rate_per_sks ?? ''
) }}" min="0" step="0.01" required>

                        @error('rate_per_sks')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="card-footer">

        <button type="submit" class="btn btn-primary">

            <i class="bi bi-check-lg"></i>

            Save

        </button>

        <a href="{{ route('honor-rate.index') }}" class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>

            Back

        </a>

    </div>

</div>
