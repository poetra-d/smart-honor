<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            Account Information

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">

                        Username <span class="text-danger">*</span>

                    </label>

                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                        value="{{ old('username', $employee->user->username ?? '') }}" required>

                    @error('username')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">

                        Email <span class="text-danger">*</span>

                    </label>

                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $employee->email ?? '') }}" required>

                    @error('email')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">

                        Role <span class="text-danger">*</span>

                    </label>

                    <select name="role" class="form-select @error('role') is-invalid @enderror" required>

                        <option value="">

                            -- Select Role --

                        </option>

                        @foreach ($roles as $role)

                            <option value="{{ $role->name }}" @selected(
                                old(
                                    'role',
                                    isset($employee)
                                    ? optional($employee->user->roles->first())->name
                                    : ''
                                ) == $role->name
                            )>

                                {{ ucwords($role->name) }}

                            </option>

                        @endforeach

                    </select>

                    @error('role')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">

                        Password

                        @isset($employee)

                            <small class="text-muted">

                                (Kosongkan jika tidak diubah)

                            </small>

                        @endisset

                    </label>

                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        {{ !isset($employee) ? 'required' : '' }}>

                    @error('password')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">

                        Confirm Password

                    </label>

                    <input type="password" name="password_confirmation" class="form-control" {{ !isset($employee) ? 'required' : '' }}>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            Employee Information

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">

                        NIP <span class="text-danger">*</span>

                    </label>

                    <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                        value="{{ old('nip', $employee->nip ?? '') }}" required>

                    @error('nip')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">

                        Name <span class="text-danger">*</span>

                    </label>

                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $employee->name ?? '') }}" required>

                    @error('name')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">

                        Phone

                    </label>

                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $employee->phone ?? '') }}">

                    @error('phone')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

        </div>

    </div>

</div>

<div class="mt-4">

    <button type="submit" class="btn btn-primary">

        <i class="bi bi-check-lg"></i>

        Save

    </button>

    <a href="{{ route('employee.index') }}" class="btn btn-secondary">

        Back

    </a>

</div>
