<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CitySeeder extends Seeder
{
    private string $baseUrl = 'https://emsifa.github.io/api-wilayah-indonesia/api';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Mengambil data cities...');

        $provinces = Province::all();

        if ($provinces->isEmpty()) {
            $this->command->error('Tabel provinces kosong! Jalankan ProvinceSeeder terlebih dahulu.');
            return;
        }

        $bar = $this->command->getOutput()->createProgressBar(count($provinces));
        $bar->start();

        foreach ($provinces as $province) {
            $response = Http::get("{$this->baseUrl}/regencies/{$province->id}.json");

            if ($response->failed()) {
                Log::warning("Gagal ambil cities untuk province_id: {$province->id}");
                $bar->advance();
                continue;
            }

            $cities = $response->json();

            foreach ($cities as $city) {
                City::updateOrCreate(
                    ['id'          => $city['id']],
                    [
                        'name'        => $city['name'],
                        'province_id' => $province->id,
                    ]
                );
            }

            $bar->advance();
        }

        $bar->finish();
        $this->command->newLine();
        $this->command->info('Cities selesai!');
    }
}