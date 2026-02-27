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
        Schema::table('employees', function (Blueprint $table) {
            $table->date('date_of_birth')->nullable()->after('job_id');
            $table->string('place_of_birth')->nullable()->after('date_of_birth');
            $table->text('address')->nullable()->after('place_of_birth');
            $table->foreignId('province_id')->nullable()->after('address')->constrained('provinces')->restrictOnDelete();
            $table->foreignId('district_id')->nullable()->after('city_id')->constrained('districts')->restrictOnDelete();
            $table->foreignId('village_id')->nullable()->after('district_id')->constrained('villages')->restrictOnDelete();
            $table->foreignId('postal_code_id')->nullable()->after('village_id')->constrained('postal_codes')->restrictOnDelete();
            $table->string('photo')->nullable()->after('postal_code_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
};