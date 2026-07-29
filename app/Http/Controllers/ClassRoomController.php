<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\ClassRoom;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClassRoomController extends Controller
{
public function index(Request $request)
    {
        $search = $request->search;

        $classrooms = ClassRoom::with([
                'studyProgram',
                'academicYear'
            ])
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('code', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhereHas('studyProgram', function ($studyProgram) use ($search) {

                            $studyProgram->where('name', 'like', "%{$search}%");

                        })
                        ->orWhereHas('academicYear', function ($academicYear) use ($search) {

                            $academicYear->where('name', 'like', "%{$search}%");

                        });

                });

            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view(
            'classroom.index',
            compact(
                'classrooms',
                'search'
            )
        );
    }

    public function create()
    {
        $studyPrograms = StudyProgram::with('faculty')->orderBy('name')->get();

        $academicYears = AcademicYear::orderBy('name')->get();

        return view(
            'classroom.create',
            compact(
                'studyPrograms',
                'academicYears'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'study_program_id' => [
                'required',
                Rule::exists('study_programs', 'id'),
            ],
            'academic_year_id' => [
                'required',
                Rule::exists('academic_years', 'id'),
            ],
            'code' => [
                'required',
                Rule::unique('classes', 'code')->whereNull('deleted_at')
            ],
            'name' => [
                'required',
                'max:100',
            ],
            'quota' => [
                'required',
                'integer',
                'min:1',
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
        ]);

        ClassRoom::create($validated);

        return redirect()
            ->route('classroom.index')
            ->with('success', 'Class berhasil ditambahkan.');
    }

    public function edit(ClassRoom $classroom)
    {
        $studyPrograms = StudyProgram::with('faculty')->orderBy('name')->get();

        $academicYears = AcademicYear::orderBy('name')->get();

        return view(
            'classroom.edit',
            compact(
                'classroom',
                'studyPrograms',
                'academicYears'
            )
        );
    }

    public function update(Request $request, ClassRoom $classroom)
    {
        $validated = $request->validate([
            'study_program_id' => [
                'required',
                Rule::exists('study_programs', 'id'),
            ],
            'academic_year_id' => [
                'required',
                Rule::exists('academic_years', 'id'),
            ],
            'code' => [
                'required',
                'max:20',
                Rule::unique('classes', 'code')
                    ->ignore($classroom->id)
                    ->withoutTrashed(),
            ],
            'name' => [
                'required',
                'max:100',
            ],
            'quota' => [
                'required',
                'integer',
                'min:1',
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
        ]);

        $classroom->update($validated);

        return redirect()
            ->route('classroom.index')
            ->with('success', 'Class berhasil diubah.');
    }

    public function destroy(ClassRoom $classroom)
    {
        $classroom->delete();

        return redirect()
            ->route('classroom.index')
            ->with('success', 'Class berhasil dihapus.');
    }
}
