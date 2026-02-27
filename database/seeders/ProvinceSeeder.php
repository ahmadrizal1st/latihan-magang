<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ProvinceSeeder extends Seeder
{
    private string $baseUrl = 'https://emsifa.github.io/api-wilayah-indonesia/api';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Mengambil data provinces...');

        $response = Http::timeout(60)
                        ->retry(3, 2000)
                        ->get("{$this->baseUrl}/provinces.json");

        if ($response->failed()) {
            $this->command->error('Gagal mengambil data provinces!');
            return;
        }

        $provinces = $response->json();

        if (empty($provinces)) {
            $this->command->error('Data provinces kosong!');
            return;
        }

        $this->command->info('Insert ' . count($provinces) . ' provinces...');
        $bar = $this->command->getOutput()->createProgressBar(count($provinces));
        $bar->start();

        $provinceData = collect($provinces)->map(fn($p) => [
            'id'         => $p['id'],
            'name'       => $p['name'],
            'created_at' => now(),
            'updated_at' => now(),
        ])
        ->unique('id')
        ->values()
        ->toArray();

        foreach (array_chunk($provinceData, 100) as $chunk) {
            Province::upsert($chunk, ['id'], ['name', 'updated_at']);
        }

        $bar->finish();
        $this->command->newLine();
        $this->command->info('Provinces selesai!');
    }
}