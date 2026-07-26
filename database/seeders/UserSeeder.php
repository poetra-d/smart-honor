<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmploymentStatus;
use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Admin Akademik
        |--------------------------------------------------------------------------
        */

        $adminUser = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@smarthonor.test',
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);

        $adminUser->assignRole('Admin Akademik');

        Employee::create([
            'user_id' => $adminUser->id,
            'nip' => 'ADM001',
            'name' => 'Administrator',
            'gender' => 'L',
            'phone' => '081111111111',
            'address' => '-',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Keuangan
        |--------------------------------------------------------------------------
        */

        $financeUser = User::create([
            'name' => 'Keuangan',
            'username' => 'keuangan',
            'email' => 'keuangan@smarthonor.test',
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);

        $financeUser->assignRole('Keuangan');

        Employee::create([
            'user_id' => $financeUser->id,
            'nip' => 'KEU001',
            'name' => 'Staff Keuangan',
            'gender' => 'P',
            'phone' => '082222222222',
            'address' => '-',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Dosen
        |--------------------------------------------------------------------------
        */

        $lecturerUser = User::create([
            'name' => 'Dosen',
            'username' => 'dosen',
            'email' => 'dosen@smarthonor.test',
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);

        $lecturerUser->assignRole('Dosen');

        $employee = Employee::create([
            'user_id' => $lecturerUser->id,
            'nip' => 'DOS001',
            'name' => 'Ahmad Dosen',
            'gender' => 'L',
            'phone' => '083333333333',
            'address' => '-',
        ]);

        $status = EmploymentStatus::where('code', 'TETAP')->first();

        Lecturer::create([
            'employee_id' => $employee->id,
            'employment_status_id' => $status->id,
            'nidn' => '1234567890',
        ]);
    }
}
