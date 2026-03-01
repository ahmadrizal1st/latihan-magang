<?php

use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CounterController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\EmployeeJobController;
use App\Http\Controllers\Api\PostalCodeController;
use App\Http\Controllers\Api\ProvinceController;
use App\Http\Controllers\Api\VillageController;
use Illuminate\Support\Facades\Route;

// Counter
Route::get('/counter', [CounterController::class, 'index']);
Route::post('/counter', [CounterController::class,'store']);
Route::put('/counter/{id}', [CounterController::class,'update']);
Route::delete('/counter/{id}', [CounterController::class,'destroy']);

// Employee
Route::get('/employee', [EmployeeController::class, 'index']);
Route::post('/employee', [EmployeeController::class,'store']);
Route::put('/employee/{id}', [EmployeeController::class,'update']);
Route::delete('/employee/{id}', [EmployeeController::class,'destroy']);

// Employee Job
Route::get('/job', [EmployeeJobController::class, 'index']);
Route::post('/job', [EmployeeJobController::class,'store']);
Route::put('/job/{id}', [EmployeeJobController::class,'update']);
Route::delete('/job/{id}', [EmployeeJobController::class,'destroy']);

// Province
Route::get('/province', [ProvinceController::class, 'index']);
Route::post('/province', [ProvinceController::class,'store']);
Route::put('/province/{id}', [ProvinceController::class,'update']);
Route::delete('/province/{id}', [ProvinceController::class,'destroy']);

// City
Route::get('/city', [CityController::class, 'index']);
Route::post('/city', [CityController::class,'store']);
Route::put('/city/{id}', [CityController::class,'update']);
Route::delete('/city/{id}', [CityController::class,'destroy']);

// District
Route::get('/district', [DistrictController::class, 'index']);
Route::post('/district', [DistrictController::class,'store']);
Route::put('/district/{id}', [DistrictController::class,'update']);
Route::delete('/district/{id}', [DistrictController::class,'destroy']);

// Village
Route::get('/village', [VillageController::class, 'index']);
Route::post('/village', [VillageController::class,'store']);
Route::put('/village/{id}', [VillageController::class,'update']);
Route::delete('/village/{id}', [VillageController::class,'destroy']);

// Postal Code
Route::get('/postal-code', [PostalCodeController::class, 'index']);
Route::post('/postal-code', [PostalCodeController::class,'store']);
Route::put('/postal-code/{id}', [PostalCodeController::class,'update']);
Route::delete('/postal-code/{id}', [PostalCodeController::class,'destroy']);