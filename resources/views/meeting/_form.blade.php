<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="row">


            <div class="col-md-12">

                <div class="mb-3">

                    <label class="form-label">
                        Schedule
                        <span class="text-danger">*</span>
                    </label>


                    <select name="schedule_id" class="form-select @error('schedule_id') is-invalid @enderror" required>


                        <option value="">
                            -- Select Schedule --
                        </option>


                        @foreach($schedules as $schedule)

                            <option value="{{ $schedule->id }}" @selected(
                                old(
                                    'schedule_id',
                                    $meeting->schedule_id ?? ''
                                ) == $schedule->id
                            )>


                                {{ $schedule->courseOffering->course->code }}
                                -
                                {{ $schedule->courseOffering->course->name }}


                                |
                                {{ $schedule->courseOffering->class->name }}


                                |
                                {{ $schedule->courseOffering->lecturer->employee->name }}


                                |
                                {{ $schedule->day }}


                            </option>


                        @endforeach


                    </select>


                    @error('schedule_id')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror


                </div>

            </div>



            <div class="col-md-4">

                <div class="mb-3">

                    <label class="form-label">
                        Meeting Number
                        <span class="text-danger">*</span>
                    </label>


                    <select name="meeting_number" class="form-select @error('meeting_number') is-invalid @enderror"
                        required>


                        <option value="">
                            -- Select Meeting --
                        </option>


                        @for($i = 1; $i <= 16; $i++)

                            <option value="{{ $i }}" @selected(
                                old(
                                    'meeting_number',
                                    $meeting->meeting_number ?? ''
                                ) == $i
                            )>

                                Pertemuan {{ $i }}

                            </option>


                        @endfor


                    </select>


                    @error('meeting_number')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror


                </div>

            </div>



            <div class="col-md-4">

                <div class="mb-3">

                    <label class="form-label">
                        Meeting Date
                    </label>


                    <input type="date" name="meeting_date"
                        class="form-control @error('meeting_date') is-invalid @enderror" value="{{ old(
    'meeting_date',
    $meeting->meeting_date ?? ''
) }}">


                    @error('meeting_date')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror


                </div>

            </div>



            <div class="col-md-4">

                <div class="mb-3">

                    <label class="form-label">
                        Status
                        <span class="text-danger">*</span>
                    </label>


                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>


                        @foreach($statuses as $status)

                            <option value="{{ $status }}" @selected(
                                old(
                                    'status',
                                    $meeting->status ?? 'Terjadwal'
                                ) == $status
                            )>

                                {{ $status }}

                            </option>


                        @endforeach


                    </select>


                    @error('status')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror


                </div>

            </div>



            <div class="col-md-12">

                <div class="mb-3">

                    <label class="form-label">
                        Topic
                    </label>


                    <input type="text" name="topic" class="form-control @error('topic') is-invalid @enderror" value="{{ old(
    'topic',
    $meeting->topic ?? ''
) }}" placeholder="Meeting topic">


                    @error('topic')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror


                </div>

            </div>



            <div class="col-md-12">

                <div class="mb-3">

                    <label class="form-label">
                        Description
                    </label>


                    <textarea name="description" rows="4"
                        class="form-control @error('description') is-invalid @enderror" placeholder="Description">{{ old(
    'description',
    $meeting->description ?? ''
) }}</textarea>


                    @error('description')

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


            <a href="{{ route('meeting.index') }}" class="btn btn-secondary">

                Back

            </a>


        </div>


    </div>

</div>
