<?php

use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\EmployeeJobController;

use Illuminate\Support\Facades\Route;


Route::get('/employee', action: [EmployeeController::class, 'index']);

Route::get('/city', action: [CityController::class, 'index']);

Route::get('/employee-job', action: [EmployeeJobController::class, 'index']);