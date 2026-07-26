<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="row">


            <div class="col-md-12">

                <div class="mb-3">

                    <label class="form-label">
                        Course Offering
                        <span class="text-danger">*</span>
                    </label>

                    <select name="course_offering_id"
                        class="form-select @error('course_offering_id') is-invalid @enderror" required>

                        <option value="">
                            -- Select Course Offering --
                        </option>


                        @foreach($courseOfferings as $courseOffering)

                            <option value="{{ $courseOffering->id }}" @selected(
                                old(
                                    'course_offering_id',
                                    $schedule->course_offering_id ?? ''
                                ) == $courseOffering->id
                            )>

                                {{ $courseOffering->course->code }}
                                -
                                {{ $courseOffering->course->name }}

                                |
                                {{ $courseOffering->class->name }}

                                |
                                {{ $courseOffering->lecturer->employee->name }}

                            </option>

                        @endforeach


                    </select>


                    @error('course_offering_id')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror


                </div>

            </div>



            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">
                        Room
                        <span class="text-danger">*</span>
                    </label>


                    <select name="room_id" class="form-select @error('room_id') is-invalid @enderror" required>


                        <option value="">
                            -- Select Room --
                        </option>


                        @foreach($rooms as $room)

                            <option value="{{ $room->id }}" @selected(
                                old(
                                    'room_id',
                                    $schedule->room_id ?? ''
                                ) == $room->id
                            )>

                                {{ $room->room_name }}

                            </option>


                        @endforeach


                    </select>


                    @error('room_id')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror


                </div>

            </div>



            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">
                        Day
                        <span class="text-danger">*</span>
                    </label>


                    <select name="day" class="form-select @error('day') is-invalid @enderror" required>


                        <option value="">
                            -- Select Day --
                        </option>


                        @foreach($days as $day)

                            <option value="{{ $day }}" @selected(
                                old(
                                    'day',
                                    $schedule->day ?? ''
                                ) == $day
                            )>

                                {{ $day }}

                            </option>


                        @endforeach


                    </select>


                    @error('day')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror


                </div>

            </div>



            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">
                        Start Time
                        <span class="text-danger">*</span>
                    </label>


                    <input type="time" name="start_time" class="form-control @error('start_time') is-invalid @enderror"
                        value="{{ old(
    'start_time',
    isset($schedule->start_time)
    ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i')
    : ''
) }}" required>


                    @error('start_time')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror


                </div>

            </div>



            <div class="col-md-6">

                <div class="mb-3">

                    <label class="form-label">
                        End Time
                        <span class="text-danger">*</span>
                    </label>


                    <input type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror"
                        value="{{ old(
    'end_time',
    isset($schedule->end_time)
    ? \Carbon\Carbon::parse($schedule->end_time)->format('H:i')
    : ''
) }}" required>


                    @error('end_time')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror


                </div>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Total Meetings
                </label>

                <input type="number" name="total_meetings"
                    class="form-control @error('total_meetings') is-invalid @enderror"
                    value="{{ old('total_meetings', $schedule->total_meetings ?? 16) }}" min="1" max="16" required>

                @error('total_meetings')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


        </div>



        <div class="mt-3">

            <button type="submit" class="btn btn-primary">

                <i class="bi bi-check-lg"></i>
                Save

            </button>


            <a href="{{ route('schedule.index') }}" class="btn btn-secondary">

                Back

            </a>


        </div>


    </div>

</div>
