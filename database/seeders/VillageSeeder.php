<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Village;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VillageSeeder extends Seeder
{
    private string $baseUrl = 'https://emsifa.github.io/api-wilayah-indonesia/api';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Mengambil data villages...');

        $districts = District::all();

        if ($districts->isEmpty()) {
            $this->command->error('Tabel districts kosong! Jalankan DistrictSeeder terlebih dahulu.');
            return;
        }

        $bar = $this->command->getOutput()->createProgressBar(count($districts));
        $bar->start();

        foreach ($districts as $district) {
            $response = Http::timeout(60)          // timeout 60 detik
                            ->retry(3, 2000)        // retry 3x, jeda 2 detik tiap retry
                            ->get("{$this->baseUrl}/villages/{$district->id}.json");

            if ($response->failed()) {
                Log::warning("Gagal ambil villages untuk district_id: {$district->id}");
                $bar->advance();
                continue;
            }

            $villages = $response->json();

            if (empty($villages)) {
                $bar->advance();
                continue;
            }

            $villageData = collect($villages)->map(fn($v) => [
                'id'          => $v['id'],
                'name'        => $v['name'],
                'district_id' => $district->id,
                'created_at'  => now(),
                'updated_at'  => now(),
            ])->toArray();

            foreach (array_chunk($villageData, 100) as $chunk) {
                Village::upsert($chunk, ['id'], ['name', 'district_id', 'updated_at']);
            }

            $bar->advance();
        }

        $bar->finish();
        $this->command->newLine();
        $this->command->info('Villages selesai!');
    }
}