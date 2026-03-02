<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'company_logo'        => 'logo/company-logo.png',
            'company_name'        => 'PT Maju Bersama Indonesia',
            'company_address'     => 'Jl. Sudirman No. 123, Gedung Graha Utama Lt. 5',
            'company_province_id' => null,
            'company_city_id'     => null,
            'company_district_id' => null,
            'company_village_id'  => null,
            'company_post_code'   => '12190',
            'company_phone'       => '021-12345678',
            'company_website'     => 'https://www.majubersama.co.id',
            'company_email'       => 'info@majubersama.co.id',
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);
    }
}