<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeeJob;
use Illuminate\Database\Seeder;

class EmployeeJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::pluck('job')   // Ambil semua nilai kolom job
        ->unique()             // Hapus duplikat
        ->each(function ($jobName) {
            EmployeeJob::firstOrCreate(['name' => $jobName]);  // Insert ke tabel jobs
            });
    }
}