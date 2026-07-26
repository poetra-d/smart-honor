<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmploymentStatus;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LecturerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $lecturers = Lecturer::with([
            'employee.user',
            'employmentStatus',
        ])
            ->when($search, function ($query) use ($search) {

                $query->where('nidn', 'like', "%{$search}%")
                    ->orWhereHas('employee', function ($employee) use ($search) {

                        $employee->where('nip', 'like', "%{$search}%")
                            ->orWhere('name', 'like', "%{$search}%");

                    });

            })
            ->orderBy('nidn')
            ->paginate(10)
            ->withQueryString();

        return view(
            'lecturer.index',
            compact(
                'lecturers',
                'search'
            )
        );
    }

    public function create()
    {
        $employmentStatuses = EmploymentStatus::orderBy('name')->get();

        $employees = Employee::with('user')
            ->whereHas('user.roles', function ($query) {

                $query->where('name', 'dosen');

            })
            ->whereDoesntHave('lecturer')
            ->orderBy('name')
            ->get();

        return view(
            'lecturer.create',
            compact('employees', 'employmentStatuses')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employment_status_id' => [
                'required',
                Rule::exists('employment_statuses', 'id'),
            ],

            'employee_id'          => [
                'required',
                Rule::exists('employees', 'id'),
            ],

            'nidn'                 => [
                'required',
                'max:20',
                Rule::unique('lecturers', 'nidn'),
            ],

        ]);

        Lecturer::create($validated);

        return redirect()
            ->route('lecturer.index')
            ->with('success', 'Lecturer berhasil ditambahkan.');
    }

    public function show(Lecturer $lecturer)
    {
        $lecturer->load([
            'employee.user.roles',
            'employee.employmentStatus',
        ]);

        return view(
            'lecturer.show',
            compact('lecturer')
        );
    }

    public function edit(Lecturer $lecturer)
    {
        $employmentStatuses = EmploymentStatus::orderBy('name')->get();
        $lecturer->load('employee');

        $employees = Employee::with('user')
            ->whereHas('user.roles', function ($query) {

                $query->where('name', 'dosen');

            })
            ->where(function ($query) use ($lecturer) {

                $query->whereDoesntHave('lecturer')
                    ->orWhere('id', $lecturer->employee_id);

            })
            ->orderBy('name')
            ->get();

        return view(
            'lecturer.edit',
            compact(
                'lecturer',
                'employees',
                'employmentStatuses'
            )
        );
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $validated = $request->validate([
            'employment_status_id' => [
                'required',
                Rule::exists('employment_statuses', 'id'),
            ],

            'employee_id'          => [
                'required',
                Rule::exists('employees', 'id'),
            ],

            'nidn'                 => [
                'required',
                'max:20',
                Rule::unique('lecturers', 'nidn')
                    ->ignore($lecturer->id),
            ],

        ]);

        $lecturer->update($validated);

        return redirect()
            ->route('lecturer.index')
            ->with('success', 'Lecturer berhasil diubah.');
    }

    public function destroy(Lecturer $lecturer)
    {
        $lecturer->delete();

        return redirect()
            ->route('lecturer.index')
            ->with('success', 'Lecturer berhasil dihapus.');
    }
}
