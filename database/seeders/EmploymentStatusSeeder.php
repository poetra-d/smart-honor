<?php

namespace Database\Seeders;

use App\Models\EmploymentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmploymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'code' => 'TETAP',
                'name' => 'Dosen Tetap',
            ],
            [
                'code' => 'LB',
                'name' => 'Dosen Luar Biasa',
            ],
        ];

        foreach ($statuses as $status) {
            EmploymentStatus::updateOrCreate(
                ['code' => $status['code']],
                $status
            );
        }
    }
}
