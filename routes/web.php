<?php

use App\Http\Controllers\Web\CityController;
use App\Http\Controllers\Web\EmployeeJobController;
use App\Http\Controllers\Web\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/employee', [EmployeeController::class, 'index']);

Route::get('/city', [CityController::class, 'index']);

Route::get('/employee-job', [EmployeeJobController::class, 'index']);