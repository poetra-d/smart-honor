<?php
namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudyProgramController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $studyPrograms = StudyProgram::with('faculty')
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('code', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhereHas('faculty', function ($faculty) use ($search) {

                            $faculty->where('name', 'like', "%{$search}%");

                        });

                });

            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view(
            'study-program.index',
            compact(
                'studyPrograms',
                'search'
            )
        );
    }

    public function create()
    {
        $faculties = Faculty::orderBy('name')->get();

        return view(
            'study-program.create',
            compact('faculties')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'faculty_id' => [
                'required',
                Rule::exists('faculties', 'id'),
            ],
            'code'       => [
                'required',
                'max:20',
                Rule::unique('study_programs', 'code')->whereNull('deleted_at'),
            ],
            'name'       => [
                'required',
                'max:100',
            ],
        ]);

        StudyProgram::create($validated);

        return redirect()
            ->route('study-program.index')
            ->with('success', 'Study Program berhasil ditambahkan.');
    }

    public function edit(StudyProgram $studyProgram)
    {
        $faculties = Faculty::orderBy('name')->get();

        return view(
            'study-program.edit',
            compact(
                'studyProgram',
                'faculties'
            )
        );
    }

    public function update(Request $request, StudyProgram $studyProgram)
    {
        $validated = $request->validate([
            'faculty_id' => [
                'required',
                Rule::exists('faculties', 'id'),
            ],
            'code'       => [
                'required',
                'max:20',
                Rule::unique('study_programs', 'code')
                    ->ignore($studyProgram->id)
                    ->withoutTrashed(),
            ],
            'name'       => [
                'required',
                'max:100',
            ],
        ]);

        $studyProgram->update($validated);

        return redirect()
            ->route('study-program.index')
            ->with('success', 'Study Program berhasil diubah.');
    }

    public function destroy(StudyProgram $studyProgram)
    {
        $studyProgram->delete();

        return redirect()
            ->route('study-program.index')
            ->with('success', 'Study Program berhasil dihapus.');
    }
}
