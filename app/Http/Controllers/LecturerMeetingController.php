<?php
namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;

class LecturerMeetingController extends Controller
{
    public function index()
    {
        $lecturer = auth()->user()
            ->employee
            ->lecturer;

        abort_if(
            ! $lecturer,
            403,
            'Akun ini bukan dosen.'
        );

        $meetings = Meeting::with([
            'schedule.courseOffering.course',
            'schedule.courseOffering.class',
        ])
            ->whereHas(
                'schedule.courseOffering',
                function ($query) use ($lecturer) {

                    $query->where(
                        'lecturer_id',
                        $lecturer->id
                    );

                }
            )
            ->orderBy('meeting_number')
            ->paginate(10);

        return view(
            'lecturer-meeting.index',
            compact('meetings')
        );
    }

    public function edit(Meeting $meeting)
    {
        $lecturer = auth()->user()
            ->employee
            ->lecturer;

        abort_if(
            ! $lecturer,
            403,
            'Akun ini bukan dosen.'
        );

        abort_unless(
            $meeting->schedule
                ->courseOffering
                ->lecturer_id == $lecturer->id,
            403
        );

        return view(
            'lecturer-meeting.edit',
            compact('meeting')
        );
    }

    public function update(Request $request, Meeting $meeting)
    {
        $lecturer = auth()->user()
            ->employee?->lecturer;

        abort_if(
            ! $lecturer,
            403,
            'Akun ini bukan dosen.'
        );

        abort_unless(
            $meeting->schedule
                ->courseOffering
                ->lecturer_id == $lecturer->id,
            403
        );

        $validated = $request->validate([

            'meeting_date' => [
                'required',
                'date',
            ],

            'topic'        => [
                'required',
                'string',
                'max:255',
            ],

            'description'  => [
                'nullable',
                'string',
            ],

        ]);

        $validated['status'] = 'Selesai';

        $meeting->update($validated);

        return redirect()
            ->route('my-meeting.index')
            ->with(
                'success',
                'Realisasi meeting berhasil disimpan.'
            );
    }

    public function show(Meeting $meeting)
    {
        $meeting->load([
            'schedule.courseOffering.course',
            'schedule.courseOffering.class',
            'schedule.room',
        ]);

        return view(
            'lecturer-meeting.show',
            compact('meeting')
        );
    }
}
