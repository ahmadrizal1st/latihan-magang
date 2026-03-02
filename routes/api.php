<?php

use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CounterController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\EmployeeJobController;
use App\Http\Controllers\Api\ProvinceController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\Api\VillageController;
use Illuminate\Support\Facades\Route;

// Counter
Route::prefix('counter')->group(function () {
    Route::get('/', [CounterController::class, 'index']);
    Route::post('/', [CounterController::class,'store']);
    Route::put('/{id}', [CounterController::class,'update']);
    Route::delete('/{id}', [CounterController::class,'destroy']);
    });

// Employee
Route::prefix('employee')->group(function () {
    Route::get('/', [EmployeeController::class, 'index']);
    Route::post('/', [EmployeeController::class, 'store']);
    Route::put('/{id}', [EmployeeController::class, 'update']);
    Route::delete('/{id}', [EmployeeController::class, 'destroy']);
    Route::post('/id-card/bulk', [EmployeeController::class, 'downloadIdCardBulk']);
    Route::get('/{id}/id-card', [EmployeeController::class, 'downloadIdCard']);
});

// Employee Job
Route::prefix('job')->group(function () {
    Route::get('/', [EmployeeJobController::class, 'index']);
    Route::post('/', [EmployeeJobController::class,'store']);
    Route::put('/{id}', [EmployeeJobController::class,'update']);
    Route::delete('/{id}', [EmployeeJobController::class,'destroy']);
});

// Province
Route::prefix('province')->group(function () {
    Route::get('/', [ProvinceController::class, 'index']);
    Route::post('/', [ProvinceController::class,'store']);
    Route::put('/{id}', [ProvinceController::class,'update']);
    Route::delete('/{id}', [ProvinceController::class,'destroy']);
});

// City
Route::prefix('city')->group(function () {
    Route::get('/', [CityController::class, 'index']);
    Route::post('/', [CityController::class,'store']);
    Route::put('/{id}', [CityController::class,'update']);
    Route::delete('/{id}', [CityController::class,'destroy']);
});

// District
Route::prefix('district')->group(function () {
    Route::get('/', [DistrictController::class, 'index']);
    Route::post('/', [DistrictController::class,'store']);
    Route::put('/{id}', [DistrictController::class,'update']);
    Route::delete('/{id}', [DistrictController::class,'destroy']);
});

// Village
Route::prefix('village')->group(function () {
    Route::get('/', [VillageController::class, 'index']);
    Route::post('/', [VillageController::class,'store']);
    Route::put('/{id}', [VillageController::class,'update']);
    Route::delete('/{id}', [VillageController::class,'destroy']);
});

// Setting
Route::get('setting', [SettingController::class, 'show']);
Route::put('setting', [SettingController::class, 'update']);