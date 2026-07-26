<?php
namespace App\Http\Controllers;

use App\Models\CourseOffering;
use App\Models\Meeting;
use App\Models\Room;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $schedules = Schedule::with([
            'courseOffering.course',
            'courseOffering.class',
            'courseOffering.lecturer.employee',
            'room',
        ])
            ->when($search, function ($query) use ($search) {

                $query->whereHas('courseOffering.course', function ($q) use ($search) {

                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%");

                });

            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'schedule.index',
            compact('schedules')
        );
    }

    public function create()
    {
        $courseOfferings = CourseOffering::with([
            'course',
            'class',
            'lecturer.employee',
        ])
            ->orderBy('id', 'desc')
            ->get();

        $rooms = Room::orderBy('room_name')
            ->get();

        $days = Schedule::DAYS;

        return view(
            'schedule.create',
            compact(
                'courseOfferings',
                'rooms',
                'days'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'course_offering_id' => [
                'required',
                Rule::exists('course_offerings', 'id'),
            ],

            'room_id'            => [
                'required',
                Rule::exists('rooms', 'id'),
            ],

            'day'                => [
                'required',
                Rule::in(Schedule::DAYS),
            ],

            'start_time'         => [
                'required',
            ],

            'end_time'           => [
                'required',
                'after:start_time',
            ],

            'total_meetings'     => [
                'required',
                'integer',
                'min:1',
                'max:16',
            ],

        ]);

        Schedule::create($validated);

        return redirect()
            ->route('schedule.index')
            ->with('success', 'Schedule berhasil ditambahkan.');
    }

    public function show(Schedule $schedule)
    {
        $schedule->load([
            'courseOffering.course',
            'courseOffering.class',
            'courseOffering.lecturer.employee',
            'room',
        ]);

        return view(
            'schedule.show',
            compact('schedule')
        );
    }

    public function edit(Schedule $schedule)
    {
        $courseOfferings = CourseOffering::with([
            'course',
            'class',
            'lecturer.employee',
        ])
            ->get();

        $rooms = Room::orderBy('room_name')->get();

        $days = Schedule::DAYS;

        return view(
            'schedule.edit',
            compact(
                'schedule',
                'courseOfferings',
                'rooms',
                'days'
            )
        );
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([

            'course_offering_id' => [
                'required',
                Rule::exists('course_offerings', 'id'),
            ],

            'room_id'            => [
                'required',
                Rule::exists('rooms', 'id'),
            ],

            'day'                => [
                'required',
                Rule::in(Schedule::DAYS),
            ],

            'start_time'         => [
                'required',
            ],

            'end_time'           => [
                'required',
                'after:start_time',
            ],

            'total_meetings'     => [
                'required',
                'integer',
                'min:1',
                'max:16',
            ],

        ]);

        $schedule->update($validated);

        return redirect()
            ->route('schedule.index')
            ->with('success', 'Schedule berhasil diubah.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()
            ->route('schedule.index')
            ->with('success', 'Schedule berhasil dihapus.');
    }

    public function generateMeeting(Schedule $schedule)
    {
        $existingMeetings = $schedule
            ->meetings()
            ->count();

        if ($existingMeetings >= 16) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Meeting sudah tersedia.'
                );

        }

        for ($i = 1; $i <= $schedule->total_meetings; $i++) {

            Meeting::firstOrCreate(
                [
                    'schedule_id'    => $schedule->id,
                    'meeting_number' => $i,
                ],
                [
                    'status' => Meeting::STATUS_SCHEDULED,
                ]
            );
        }
        return redirect()
            ->back()
            ->with(
                'success',
                '16 meeting berhasil dibuat.'
            );
    }
}
