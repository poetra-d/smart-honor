<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SemesterController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $semesters = Semester::when($search, function ($query) use ($search) {

            $query->where(function ($q) use ($search) {

                $q->where('code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");

            });

        })
        ->orderByDesc('id')
        ->paginate(10)
        ->withQueryString();

        return view(
            'semester.index',
            compact(
                'semesters',
                'search'
            )
        );
    }

    public function create()
    {
        return view('semester.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                'max:20',
                Rule::unique('semesters', 'code'),
            ],
            'name' => [
                'required',
                'max:100',
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
        ]);

        if ($validated['is_active']) {

            Semester::query()->update([
                'is_active' => false,
            ]);

        }

        Semester::create($validated);

        return redirect()
            ->route('semester.index')
            ->with('success', 'Semester berhasil ditambahkan.');
    }

    public function edit(Semester $semester)
    {
        return view(
            'semester.edit',
            compact('semester')
        );
    }

    public function update(Request $request, Semester $semester)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                'max:20',
                Rule::unique('semesters', 'code')
                    ->ignore($semester->id),
            ],
            'name' => [
                'required',
                'max:100',
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
        ]);

        if ($validated['is_active']) {

            Semester::query()->update([
                'is_active' => false,
            ]);

        }

        $semester->update($validated);

        return redirect()
            ->route('semester.index')
            ->with('success', 'Semester berhasil diubah.');
    }

    public function destroy(Semester $semester)
    {
        $semester->delete();

        return redirect()
            ->route('semester.index')
            ->with('success', 'Semester berhasil dihapus.');
    }
}
