<?php
namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AcademicYearController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $academicYears = AcademicYear::when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            });
        })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view(
            'academic-year.index',
            compact(
                'academicYears',
                'search'
            )
        );
    }

    public function create()
    {
        return view('academic-year.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'      => [
                'required',
                'max:20',
                Rule::unique('academic_years', 'code')->whereNull('deleted_at'),
            ],
            'name'      => [
                'required',
                'max:100',
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
        ]);

        if ($validated['is_active']) {
            AcademicYear::query()->update([
                'is_active' => false,
            ]);
        }

        AcademicYear::create($validated);

        return redirect()
            ->route('academic-year.index')
            ->with('success', 'Academic Year berhasil ditambahkan.');
    }

    public function edit(AcademicYear $academicYear)
    {
        return view(
            'academic-year.edit',
            compact('academicYear')
        );
    }

    public function update(Request $request, AcademicYear $academicYear)
    {
        $validated = $request->validate([
            'code'      => [
                'required',
                'max:20',
                Rule::unique('academic_years', 'code')
                    ->ignore($academicYear->id)
                    ->withoutTrashed(),
            ],
            'name'      => [
                'required',
                'max:100',
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
        ]);

        if ($validated['is_active']) {
            AcademicYear::query()->update([
                'is_active' => false,
            ]);
        }

        $academicYear->update($validated);

        return redirect()
            ->route('academic-year.index')
            ->with('success', 'Academic Year berhasil diubah.');
    }

    public function destroy(AcademicYear $academicYear)
    {
        $academicYear->delete();

        return redirect()
            ->route('academic-year.index')
            ->with('success', 'Academic Year berhasil dihapus.');
    }
}
