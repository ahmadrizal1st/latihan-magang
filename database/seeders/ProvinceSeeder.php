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

        $response = Http::get("{$this->baseUrl}/provinces.json");

        if ($response->failed()) {
            $this->command->error('Gagal mengambil data provinces!');
            return;
        }

        $provinces = $response->json();

        $this->command->info('Insert ' . count($provinces) . ' provinces...');
        $bar = $this->command->getOutput()->createProgressBar(count($provinces));
        $bar->start();

        foreach ($provinces as $province) {
            Province::updateOrCreate(
                ['id'   => $province['id']],
                ['name' => $province['name']]
            );
            $bar->advance();
        }

        $bar->finish();
        $this->command->newLine();
        $this->command->info('Provinces selesai!');
    }
}