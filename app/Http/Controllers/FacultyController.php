<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $faculties = Faculty::when($search, function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%");
            })
            ->orderBy('code')
            ->paginate(15)
            ->withQueryString();

        return view('faculty.index', compact('faculties', 'search'));
    }

    public function create()
    {
        return view('faculty.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:faculties,code',
            'name' => 'required',
        ]);

        Faculty::create($request->all());

        return redirect()
            ->route('faculty.index')
            ->with('success', 'Faculty berhasil ditambahkan');
    }

    public function edit(Faculty $faculty)
    {
        return view('faculty.edit', compact('faculty'));
    }

    public function update(Request $request, Faculty $faculty)
    {
        $request->validate([
            'code' => 'required|unique:faculties,code,' . $faculty->id,
            'name' => 'required',
        ]);

        $faculty->update($request->all());

        return redirect()
            ->route('faculty.index')
            ->with('success', 'Faculty berhasil diupdate');
    }

    public function destroy(Faculty $faculty)
    {
        $faculty->delete();

        return redirect()
            ->route('faculty.index')
            ->with('success', 'Faculty berhasil dihapus');
    }
}
