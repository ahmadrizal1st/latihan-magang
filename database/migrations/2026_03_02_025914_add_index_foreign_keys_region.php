<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // cities: index province_id for withCount cities in province
        Schema::table('cities', function (Blueprint $table) {
            $table->index('province_id');
        });

        // districts: index city_id for withCount districts in city
        Schema::table('districts', function (Blueprint $table) {
            $table->index('city_id');
        });

        // villages: index district_id → main cause of 13s query
        Schema::table('villages', function (Blueprint $table) {
            $table->index('district_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};