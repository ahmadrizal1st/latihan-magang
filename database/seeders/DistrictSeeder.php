<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DistrictSeeder extends Seeder
{
    private string $baseUrl = 'https://emsifa.github.io/api-wilayah-indonesia/api';
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Mengambil data districts...');

        $cities = City::all();

        if ($cities->isEmpty()) {
            $this->command->error('Tabel cities kosong! Jalankan CitySeeder terlebih dahulu.');
            return;
        }

        $bar = $this->command->getOutput()->createProgressBar(count($cities));
        $bar->start();

        foreach ($cities as $city) {
            $response = Http::get("{$this->baseUrl}/districts/{$city->id}.json");

            if ($response->failed()) {
                Log::warning("Gagal ambil districts untuk city_id: {$city->id}");
                $bar->advance();
                continue;
            }

            $districts = $response->json();

            foreach ($districts as $district) {
                District::updateOrCreate(
                    ['id'      =>  $district['id']],
                    [
                        'name'    => $district['name'],
                        'city_id' => $city->id,
                    ]
                );
            }

            $bar->advance();
        }

        $bar->finish();
        $this->command->newLine();
        $this->command->info('Districts selesai!');
    }
}