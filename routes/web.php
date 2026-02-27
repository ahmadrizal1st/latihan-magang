<?php

use App\Http\Controllers\Web\CityController;
use App\Http\Controllers\Web\EmployeeJobController;
use App\Http\Controllers\Web\EmployeeController;
use Illuminate\Support\Facades\Route;

// Employee
Route::get('/employee', [EmployeeController::class, 'index']);

// City
Route::get('/city', [CityController::class, 'index']);

// Employee Job
Route::get('/employee-job', [EmployeeJobController::class, 'index']);