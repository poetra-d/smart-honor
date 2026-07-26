<div class="row">

    <div class="col-md-3">

        <div class="mb-3">

            <label class="form-label">

                Nama Ruangan <span class="text-danger">*</span>

            </label>

            <input type="text" name="room_name" class="form-control @error('room_name') is-invalid @enderror"
                value="{{ old('room_name', $room->room_name ?? '') }}" required>

            @error('room_name')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </div>

    <div class="col-md-6">

        <div class="mb-3">

            <label class="form-label">

                Nama Gedung <span class="text-danger">*</span>

            </label>

            <input type="text" name="building_name" class="form-control @error('building_name') is-invalid @enderror"
                value="{{ old('building_name', $room->building_name ?? '') }}" required>

            @error('building_name')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </div>

    <div class="col-md-3">

        <div class="mb-3">

            <label class="form-label">

                Capacity <span class="text-danger">*</span>

            </label>

            <input type="number" name="capacity" class="form-control @error('capacity') is-invalid @enderror"
                value="{{ old('capacity', $room->capacity ?? '') }}" min="1" required>

            @error('capacity')

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

    <a href="{{ route('room.index') }}" class="btn btn-secondary">

        Back

    </a>

</div>
