<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_logo')->nullable();
            $table->string('company_name');
            $table->text('company_address')->nullable();
            $table->foreignId('company_province_id')->nullable()->constrained('provinces')->nullOnDelete();
            $table->foreignId('company_city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->foreignId('company_district_id')->nullable()->constrained('districts')->nullOnDelete();
            $table->foreignId('company_village_id')->nullable()->constrained('villages')->nullOnDelete();
            $table->string('company_post_code', 10)->nullable();
            $table->string('company_phone', 20)->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_email')->nullable();
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => 'SettingSeeder',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};