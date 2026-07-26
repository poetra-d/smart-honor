<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $employees = Employee::with([
            'user.roles',
        ])
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {
                    $q->where('nip', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($user) use ($search) {
                            $user->where('username', 'like', "%{$search}%");
                        });
                });

            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view(
            'employee.index',
            compact(
                'employees',
                'search'
            )
        );
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view(
            'employee.create',
            compact('roles')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'username' => [
                'required',
                'max:50',
                Rule::unique('users', 'username'),
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],

            'nip'      => [
                'required',
                'max:30',
                Rule::unique('employees', 'nip'),
            ],

            'name'     => [
                'required',
                'max:150',
            ],

            'email'    => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],

            'phone'    => [
                'nullable',
                'max:20',
            ],

            'role'     => [
                'required',
                Rule::exists('roles', 'name'),
            ],

        ]);

        DB::transaction(function () use ($validated) {

            $user = User::create([
                'name'      => $validated['name'],
                'username'  => $validated['username'],
                'email'     => $validated['email'],
                'is_active' => 1,
                'password'  => Hash::make($validated['password']),
            ]);

            $user->assignRole($validated['role']);

            Employee::create([
                'user_id' => $user->id,
                'nip'     => $validated['nip'],
                'name'    => $validated['name'],
                'email'   => $validated['email'],
                'phone'   => $validated['phone'],
                'gender'  => 'L',
                'address' => 'Alamat'
            ]);
        });

        return redirect()
            ->route('employee.index')
            ->with('success', 'Employee berhasil ditambahkan.');
    }

    public function show(Employee $employee)
    {
        $employee->load([
            'user.roles',
            'lecturer',
        ]);

        return view(
            'employee.show',
            compact('employee')
        );
    }

    public function edit(Employee $employee)
    {
        $employee->load('user.roles');

        $roles = Role::orderBy('name')->get();

        return view(
            'employee.edit',
            compact(
                'roles',
                'employee',
            )
        );
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([

            'username' => [
                'required',
                Rule::unique('users', 'username')
                    ->ignore($employee->user_id),
            ],

            'nip'      => [
                'required',
                Rule::unique('employees', 'nip')
                    ->ignore($employee->id),
            ],

            'name'     => [
                'required',
                'max:150',
            ],

            'email'    => [
                'required',
                'email',
                Rule::unique('users', 'email')
                    ->ignore($employee->user_id),
            ],

            'phone'    => [
                'nullable',
                'max:20',
            ],

            'password' => [
                'nullable',
                'confirmed',
                'min:8',
            ],

            'role'     => [
                'required',
                Rule::exists('roles', 'name'),
            ],

        ]);

        DB::transaction(function () use ($employee, $validated) {

            $user = $employee->user;

            $user->name     = $validated['name'];
            $user->username = $validated['username'];
            $user->email    = $validated['email'];

            if (! empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }

            $user->save();

            $user->syncRoles([
                $validated['role'],
            ]);

            $employee->update([
                'nip'   => $validated['nip'],
                'name'  => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
            ]);
        });

        return redirect()
            ->route('employee.index')
            ->with('success', 'Employee berhasil diubah.');
    }

    public function destroy(Employee $employee)
    {
        DB::transaction(function () use ($employee) {

            $user = $employee->user;

            $employee->delete();

            $user->delete();

        });

        return redirect()
            ->route('employee.index')
            ->with('success', 'Employee berhasil dihapus.');
    }
}
