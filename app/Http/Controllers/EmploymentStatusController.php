<?php
namespace App\Http\Controllers;

use App\Models\EmploymentStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmploymentStatusController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $employmentStatuses = EmploymentStatus::when($search, function ($query) use ($search) {
            $query->where('code', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%");
        })
            ->orderBy('code')
            ->paginate(15)
            ->withQueryString();

        return view('employment-status.index', compact(
            'employmentStatuses',
            'search'
        ));
    }

    public function create()
    {
        return view('employment-status.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                Rule::unique('employment_statuses', 'code')->whereNull('deleted_at')
            ],
            'name' => 'required|max:100',
        ]);

        EmploymentStatus::create($validated);

        return redirect()
            ->route('employment-status.index')
            ->with('success', 'Employment Status berhasil ditambahkan.');
    }

    public function edit(EmploymentStatus $employmentStatus)
    {
        return view('employment-status.edit', compact(
            'employmentStatus'
        ));
    }

    public function update(Request $request, EmploymentStatus $employmentStatus)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                Rule::unique('employment_statuses', 'code')
                    ->ignore($employmentStatus->id)
                    ->withoutTrashed(),
            ],
            'name' => 'required|max:100',
        ]);

        $employmentStatus->update($validated);

        return redirect()
            ->route('employment-status.index')
            ->with('success', 'Employment Status berhasil diubah.');
    }

    public function destroy(EmploymentStatus $employmentStatus)
    {
        $employmentStatus->delete();

        return redirect()
            ->route('employment-status.index')
            ->with('success', 'Employment Status berhasil dihapus.');
    }
}
