<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::pluck('city')   // Ambil semua nilai kolom city
        ->unique()             // Hapus duplikat
        ->each(function ($cityName) {
            City::firstOrCreate(['name' => $cityName]);  // Insert ke tabel cities
            });
    }
}