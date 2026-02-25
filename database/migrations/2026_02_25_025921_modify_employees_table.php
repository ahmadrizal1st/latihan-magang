<?php

use App\Models\City;
use App\Models\Employee;
use App\Models\EmployeeJob;
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
        /**
         * Modify the employees table
         * Buat kolom baru city_id dan job_id 
         * Ambil data id dari tabel job dan city pindahkan ke kolom city_id dan job_id cocokan data dengan kolom job dan city pada tabel employees
         * Hapus kolom job dan city
         */

        // Tambahkan kolom city_id dan job_id
        Schema::table('employees', function (Blueprint $table) {
            $table->foreignId('city_id')->nullable()->constrained('cities')->after('name');
            $table->foreignId('job_id')->nullable()->constrained('employee_jobs')->after('city_id');
        });

        // Ambil data id dari tabel job dan city pindahkan ke kolom city_id dan job_id cocokan data dengan kolom job dan city pada tabel employees
        Employee::all()->each(function ( $employee) {
            $city = City::where('name', $employee->city)->first();
            $employeeJob = EmployeeJob::where('name', $employee->job)->first();
            
            $employee->update([
                'city_id'=> $city->id,
                'job_id'=> $employeeJob->id,
            ]);
        });


        // Hapus kolom job dan city
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['city','job']);
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