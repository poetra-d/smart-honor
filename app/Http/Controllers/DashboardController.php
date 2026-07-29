<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\HonorPayment;
use App\Models\Lecturer;
use App\Models\Meeting;
use App\Models\Schedule;

class DashboardController extends Controller
{
    public function index()
    {

        $user = auth()->user();

        if ($user->hasRole('Admin Akademik')) {

            return $this->adminDashboard();

        }

        if ($user->hasRole('Keuangan')) {

            return $this->financeDashboard();

        }

        if ($user->hasRole('Dosen')) {

            return $this->lecturerDashboard();

        }

        abort(403);

    }

    private function adminDashboard()
    {

        return view(
            'dashboard.index',
            [

                'type'          => 'admin',

                'totalLecturer' =>
                Lecturer::count(),

                'totalCourse'   =>
                Course::count(),

                'totalSchedule' =>
                Schedule::count(),

            ]
        );

    }

    private function financeDashboard()
    {

        $month = now()->month;
        $year  = now()->year;

        return view(
            'dashboard.index',
            [

                'type'         => 'finance',

                'totalPayment' => HonorPayment::count(),

                'draftPayment' => HonorPayment::where(
                    'status',
                    HonorPayment::STATUS_DRAFT
                )->count(),

                'paidPayment'  => HonorPayment::where(
                    'status',
                    HonorPayment::STATUS_PAID
                )->count(),

                'totalHonor'   => HonorPayment::whereMonth(
                    'generated_at',
                    $month
                )
                    ->whereYear(
                        'generated_at',
                        $year
                    )
                    ->where('status', HonorPayment::STATUS_PAID)
                    ->sum('total'),

            ]
        );

    }

    private function lecturerDashboard()
    {

        $lecturer = auth()
            ->user()
            ->employee?->lecturer;

        abort_if(
            ! $lecturer,
            403,
            'Akun ini bukan dosen.'
        );

        return view(
            'dashboard.index',
            [

                'type'             => 'lecturer',

                'totalMeeting'     => Meeting::whereHas(
                    'schedule.courseOffering',
                    function ($q) use ($lecturer) {

                        $q->where(
                            'lecturer_id',
                            $lecturer->id
                        );

                    }
                )->count(),

                'completedMeeting' => Meeting::whereHas(
                    'schedule.courseOffering',
                    function ($q) use ($lecturer) {

                        $q->where(
                            'lecturer_id',
                            $lecturer->id
                        );

                    }
                )
                    ->where(
                        'status',
                        Meeting::STATUS_COMPLETED
                    )
                    ->count(),

                'totalHonor'       => HonorPayment::where(
                    'lecturer_id',
                    $lecturer->id
                )
                    ->where('status', HonorPayment::STATUS_PAID)
                    ->sum('total'),

            ]
        );

    }
}
