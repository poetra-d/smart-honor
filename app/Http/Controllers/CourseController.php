<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $courses = Course::with('studyProgram')
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('code', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhereHas('studyProgram', function ($studyProgram) use ($search) {

                            $studyProgram->where('name', 'like', "%{$search}%");

                        });

                });

            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view(
            'course.index',
            compact(
                'courses',
                'search'
            )
        );
    }

    public function create()
    {
        $studyPrograms = StudyProgram::orderBy('name')->get();

        return view(
            'course.create',
            compact('studyPrograms')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'study_program_id' => [
                'required',
                Rule::exists('study_programs', 'id'),
            ],
            'code'             => [
                'required',
                'max:20',
                Rule::unique('courses', 'code'),
            ],
            'name'             => [
                'required',
                'max:150',
            ],
            'sks'      => [
                'required',
                'integer',
                'min:1',
                'max:6',
            ],
        ]);

        Course::create($validated);

        return redirect()
            ->route('course.index')
            ->with('success', 'Course berhasil ditambahkan.');
    }

    public function edit(Course $course)
    {
        $studyPrograms = StudyProgram::orderBy('name')->get();

        return view(
            'course.edit',
            compact(
                'course',
                'studyPrograms'
            )
        );
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'study_program_id' => [
                'required',
                Rule::exists('study_programs', 'id'),
            ],
            'code'             => [
                'required',
                'max:20',
                Rule::unique('courses', 'code')
                    ->ignore($course->id),
            ],
            'name'             => [
                'required',
                'max:150',
            ],
            'sks'      => [
                'required',
                'integer',
                'min:1',
                'max:6',
            ],
        ]);

        $course->update($validated);

        return redirect()
            ->route('course.index')
            ->with('success', 'Course berhasil diubah.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()
            ->route('course.index')
            ->with('success', 'Course berhasil dihapus.');
    }
}
