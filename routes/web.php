<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseOfferingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmploymentStatusController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HonorPaymentController;
use App\Http\Controllers\HonorRateController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\LecturerHonorController;
use App\Http\Controllers\LecturerMeetingController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StudyProgramController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Admin Akademik
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Admin Akademik')->group(function () {
        Route::resource('employment-status', EmploymentStatusController::class);
        Route::resource('faculty', FacultyController::class);
        Route::resource('study-program', StudyProgramController::class);
        Route::resource('academic-year', AcademicYearController::class);
        Route::resource('semester', SemesterController::class);
        Route::resource('course', CourseController::class);
        Route::resource('room', RoomController::class);
        Route::resource('classroom', ClassRoomController::class);
        Route::resource('employee', EmployeeController::class);
        Route::resource('lecturer', LecturerController::class);
        Route::resource('course-offering', CourseOfferingController::class);
        Route::resource('schedule', ScheduleController::class);
        Route::post(
            '/schedule/{schedule}/generate-meeting',
            [ScheduleController::class, 'generateMeeting']
        )->name('schedule.generate-meeting');

        Route::resource('meeting', MeetingController::class);

    });

    /*
    |--------------------------------------------------------------------------
    | Dosen
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Dosen')->group(function () {

        Route::get(
            '/my-meeting',
            [LecturerMeetingController::class, 'index']
        )->name('my-meeting.index');

        Route::get(
            '/my-meeting/{meeting}/edit',
            [LecturerMeetingController::class, 'edit']
        )->name('my-meeting.edit');

        Route::put(
            '/my-meeting/{meeting}',
            [LecturerMeetingController::class, 'update']
        )->name('my-meeting.update');

        Route::get('/my-meeting/{meeting}',
            [LecturerMeetingController::class, 'show']
        )->name('my-meeting.show');

        Route::get(
            '/my-honor',
            [LecturerHonorController::class, 'index']
        )
            ->name('my-honor.index');

        Route::get(
            '/my-honor/{honorPayment}',
            [LecturerHonorController::class, 'show']
        )
            ->name('my-honor.show');

    });

    /*
    |--------------------------------------------------------------------------
    | Keuangan
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Keuangan')->group(function () {

        Route::resource('honor-rate', HonorRateController::class);
        Route::prefix('honor-payment')
            ->name('honor-payment.')
            ->group(function () {

                Route::get('/', [HonorPaymentController::class, 'index'])
                    ->name('index');

                Route::get('/generate', [HonorPaymentController::class, 'generateForm'])
                    ->name('generate.form');

                Route::post('/generate', [HonorPaymentController::class, 'generate'])
                    ->name('generate');

                Route::get(
                    'export-summary',
                    [HonorPaymentController::class, 'exportSummary']
                )->name('export.summary');

                Route::get(
                    'export-detail',
                    [HonorPaymentController::class, 'exportDetail']
                )->name('export.detail');

                Route::get('/{honorPayment}', [HonorPaymentController::class, 'show'])
                    ->name('show');

                Route::put('/{honorPayment}/paid', [HonorPaymentController::class, 'paid'])
                    ->name('paid');

                Route::put('/{honorPayment}/cancel-paid', [HonorPaymentController::class, 'cancel'])
                    ->name('cancel');

            });

    });
});
