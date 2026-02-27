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
            if (City::where('province_id', $province->id)->exists()) {
                $bar->advance();
                continue;
            }

            $response = Http::timeout(60)
                            ->retry(3, 2000)
                            ->get("{$this->baseUrl}/regencies/{$province->id}.json");

            if ($response->failed()) {
                Log::warning("Gagal ambil cities untuk province_id: {$province->id}");
                $bar->advance();
                continue;
            }

            $cities = $response->json();

            if (empty($cities)) {
                $bar->advance();
                continue;
            }

            $cityData = collect($cities)->map(fn($c) => [
                'id'          => $c['id'],
                'name'        => $c['name'],
                'province_id' => $province->id,
                'created_at'  => now(),
                'updated_at'  => now(),
            ])
            ->unique('id')
            ->values()
            ->toArray();

            foreach (array_chunk($cityData, 100) as $chunk) {
                City::upsert($chunk, ['id'], ['name', 'province_id', 'updated_at']);
            }

            $bar->advance();
        }

        $bar->finish();
        $this->command->newLine();
        $this->command->info('Cities selesai!');
    }
}