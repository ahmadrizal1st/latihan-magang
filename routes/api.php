<?php

use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\EmployeeJobController;

use Illuminate\Support\Facades\Route;


// Employee
Route::get('/employee', [EmployeeController::class, 'index']);
Route::post('/employee', [EmployeeController::class,'store']);
Route::put('/employee/{id}', [EmployeeController::class,'update']);
Route::delete('/employee/{id}', [EmployeeController::class,'destroy']);

// City
Route::get('/city', [CityController::class, 'index']);
Route::post('/city', [CityController::class,'store']);
Route::put('/city/{id}', [CityController::class,'update']);
Route::delete('/city/{id}', [CityController::class,'destroy']);

// Employee Job
Route::get('/employee-job', [EmployeeJobController::class, 'index']);
Route::post('/employee-job', [EmployeeJobController::class,'store']);
Route::put('/employee-job/{id}', [EmployeeJobController::class,'update']);
Route::delete('/employee-job/{id}', [EmployeeJobController::class,'destroy']);