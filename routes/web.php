<?php

use App\Http\Controllers\Web\PostalCodeController;
use App\Http\Controllers\Web\CityController;
use App\Http\Controllers\Web\CounterController;
use App\Http\Controllers\Web\DistrictController;
use App\Http\Controllers\Web\EmployeeController;
use App\Http\Controllers\Web\EmployeeJobController;
use App\Http\Controllers\Web\ProvinceController;
use App\Http\Controllers\Web\VillageController;
use Illuminate\Support\Facades\Route;

// Counter
Route::get('/counter', [CounterController::class, 'index']);

// Employee
Route::get('/employee', [EmployeeController::class, 'index']);

// Employee Job
Route::get('/job', [EmployeeJobController::class, 'index']);

// Province
Route::get('/province', [ProvinceController::class,'index']);

// City
Route::get('/city', [CityController::class, 'index']);

// District
Route::get('/district', [DistrictController::class,'index']);

// Village
Route::get('/village', [VillageController::class,'index']);

// Village
Route::get('/postal-code', [PostalCodeController::class,'index']);