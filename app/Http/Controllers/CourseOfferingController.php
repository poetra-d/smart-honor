<?php
namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\ClassRoom;
use App\Models\Course;
use App\Models\CourseOffering;
use App\Models\Lecturer;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseOfferingController extends Controller
{
    public function index(Request $request)
    {
        $search         = $request->search;
        $academicYearId = $request->academic_year_id;
        $semesterId     = $request->semester_id;

        $courseOfferings = CourseOffering::with([
            'academicYear',
            'semester',
            'course',
            'class',
            'lecturer.employee',
        ])
            ->when($academicYearId, function ($query) use ($academicYearId) {
                $query->where('academic_year_id', $academicYearId);
            })
            ->when($semesterId, function ($query) use ($semesterId) {
                $query->where('semester_id', $semesterId);
            })
            ->when($search, function ($query) use ($search) {

                $query->whereHas('course', function ($course) use ($search) {

                    $course->where('code', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%");

                })->orWhereHas('lecturer.employee', function ($employee) use ($search) {

                    $employee->where('name', 'like', "%{$search}%")
                        ->orWhere('nip', 'like', "%{$search}%");

                });

            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $academicYears = AcademicYear::orderBy('name')->get();
        $semesters     = Semester::orderBy('name')->get();

        return view(
            'course-offering.index',
            compact(
                'courseOfferings',
                'academicYears',
                'semesters'
            )
        );
    }

    public function create()
    {
        $academicYears = AcademicYear::orderBy('name')->get();
        $semesters     = Semester::orderBy('name')->get();
        $courses       = Course::orderBy('name')->get();
        $classes       = ClassRoom::orderBy('name')->get();
        $lecturers     = Lecturer::with('employee')
            ->orderBy('nidn')
            ->get();

        return view(
            'course-offering.create',
            compact(
                'academicYears',
                'semesters',
                'courses',
                'classes',
                'lecturers'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'academic_year_id' => [
                'required',
                Rule::exists('academic_years', 'id'),
            ],

            'semester_id'      => [
                'required',
                Rule::exists('semesters', 'id'),
            ],

            'course_id'        => [
                'required',
                Rule::exists('courses', 'id'),
                Rule::unique('course_offerings')
                    ->where(function ($query) use ($request) {
                        return $query
                            ->where('academic_year_id', $request->academic_year_id)
                            ->where('semester_id', $request->semester_id)
                            ->where('course_id', $request->course_id)
                            ->where('class_id', $request->class_id);
                    }),
            ],

            'class_id'         => [
                'required',
                Rule::exists('classes', 'id'),
            ],

            'lecturer_id'      => [
                'required',
                Rule::exists('lecturers', 'id'),
            ],

            'quota'            => [
                'required',
                'integer',
                'min:1',
            ],

        ]);

        CourseOffering::create($validated);

        return redirect()
            ->route('course-offering.index')
            ->with('success', 'Course offering berhasil ditambahkan.');
    }

    public function show(CourseOffering $courseOffering)
    {
        $courseOffering->load([
            'academicYear',
            'semester',
            'course.studyProgram',
            'class',
            'lecturer.employee',
            'lecturer.employmentStatus',
        ]);

        return view(
            'course-offering.show',
            compact('courseOffering')
        );
    }

    public function edit(CourseOffering $courseOffering)
    {
        $academicYears = AcademicYear::orderBy('name')->get();
        $semesters     = Semester::orderBy('name')->get();
        $courses       = Course::orderBy('name')->get();
        $classes       = ClassRoom::orderBy('name')->get();
        $lecturers     = Lecturer::with('employee')
            ->orderBy('nidn')
            ->get();

        return view(
            'course-offering.edit',
            compact(
                'courseOffering',
                'academicYears',
                'semesters',
                'courses',
                'classes',
                'lecturers'
            )
        );
    }

    public function update(Request $request, CourseOffering $courseOffering)
    {
        $validated = $request->validate([

            'academic_year_id' => [
                'required',
                Rule::exists('academic_years', 'id'),
            ],

            'semester_id'      => [
                'required',
                Rule::exists('semesters', 'id'),
            ],

            'course_id'        => [
                'required',
                Rule::exists('courses', 'id'),
            ],

            'class_id'         => [
                'required',
                Rule::exists('classes', 'id'),
            ],

            'lecturer_id'      => [
                'required',
                Rule::exists('lecturers', 'id'),
            ],

            'quota'            => [
                'required',
                'integer',
                'min:1',
            ],

            Rule::unique('course_offerings')
                ->ignore($courseOffering->id)
                ->where(function ($query) use ($request) {

                    return $query
                        ->where('academic_year_id', $request->academic_year_id)
                        ->where('semester_id', $request->semester_id)
                        ->where('course_id', $request->course_id)
                        ->where('class_id', $request->class_id);

                }),

        ]);

        $courseOffering->update($validated);

        return redirect()
            ->route('course-offering.index')
            ->with('success', 'Course offering berhasil diubah.');
    }

    public function destroy(CourseOffering $courseOffering)
    {
        $courseOffering->delete();

        return redirect()
            ->route('course-offering.index')
            ->with('success', 'Course offering berhasil dihapus.');
    }
}
