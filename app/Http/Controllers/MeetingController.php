<?php
namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Schedule;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index(Request $request)
    {
        $meetings = Meeting::with([
            'schedule.courseOffering.course',
            'schedule.courseOffering.class',
            'schedule.courseOffering.lecturer.employee',
        ])
            ->when($request->search, function ($query) use ($request) {

                $query->whereHas('schedule.courseOffering.course', function ($q) use ($request) {

                    $q->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('code', 'like', '%' . $request->search . '%');

                });

            })
            ->orderBy('meeting_number')
            ->paginate(10)
            ->withQueryString();

        return view(
            'meeting.index',
            compact('meetings')
        );
    }

    public function create()
    {
        $schedules = Schedule::with([
            'courseOffering.course',
            'courseOffering.class',
            'courseOffering.lecturer.employee',
        ])
            ->get();

        $statuses = Meeting::STATUSES;

        return view(
            'meeting.create',
            compact(
                'schedules',
                'statuses'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'schedule_id'    => [
                'required',
                Rule::exists('schedules', 'id'),
            ],

            'meeting_number' => [
                'required',
                'integer',
                'min:1',
                'max:16',
            ],

            'meeting_date'   => [
                'nullable',
                'date',
            ],

            'topic'          => [
                'nullable',
                'string',
            ],

            'description'    => [
                'nullable',
                'string',
            ],

            'status'         => [
                'required',
                Rule::in(Meeting::STATUS),
            ],

        ]);

        Meeting::create($validated);

        return redirect()
            ->route('meeting.index')
            ->with('success', 'Meeting berhasil ditambahkan.');
    }

    public function show(Meeting $meeting)
    {
        $meeting->load([
            'schedule.courseOffering.course',
            'schedule.courseOffering.class',
            'schedule.courseOffering.lecturer.employee',
        ]);

        return view(
            'meeting.show',
            compact('meeting')
        );
    }

    public function edit(Meeting $meeting)
    {
        $schedules = Schedule::with([
            'courseOffering.course',
            'courseOffering.class',
            'courseOffering.lecturer.employee',
        ])
            ->get();

        $statuses = Meeting::STATUS;

        return view(
            'meeting.edit',
            compact(
                'meeting',
                'schedules',
                'statuses'
            )
        );
    }

    public function update(Request $request, Meeting $meeting)
    {
        $validated = $request->validate([

            'schedule_id'    => [
                'required',
                Rule::exists('schedules', 'id'),
            ],

            'meeting_number' => [
                'required',
                'integer',
                'min:1',
                'max:16',
            ],

            'meeting_date'   => [
                'nullable',
                'date',
            ],

            'topic'          => [
                'nullable',
                'string',
            ],

            'description'    => [
                'nullable',
                'string',
            ],

            'status'         => [
                'required',
                Rule::in(Meeting::STATUS),
            ],

        ]);

        $meeting->update($validated);

        return redirect()
            ->route('meeting.index')
            ->with('success', 'Meeting berhasil diubah.');
    }

    public function destroy(Meeting $meeting)
    {
        $meeting->delete();

        return redirect()
            ->route('meeting.index')
            ->with('success', 'Meeting berhasil dihapus.');
    }
}
