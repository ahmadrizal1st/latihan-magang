<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\CityController;
use App\Http\Controllers\Web\CounterController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\DistrictController;
use App\Http\Controllers\Web\EmployeeController;
use App\Http\Controllers\Web\EmployeeJobController;
use App\Http\Controllers\Web\ProvinceController;
use App\Http\Controllers\Web\SettingController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\VillageController;
use App\Http\Controllers\Web\LeaveRequestController;
use Illuminate\Support\Facades\Route;

// User
Route::get('/user', [UserController::class , 'index']);

// Auth
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class , 'login']);
    Route::get('/register', [AuthController::class , 'register']);
    Route::post('/login', [AuthController::class , 'doLogin']);
    Route::post('/logout', [AuthController::class , 'doLogout']);
    Route::get('/me', [AuthController::class , 'me']);
});

// Dashboard
Route::get('/dashboard', [DashboardController::class , 'index']);

// Counter
Route::get('/counter', [CounterController::class , 'index']);

// Employee
Route::get('/employee', [EmployeeController::class , 'index']);

// Employee Job
Route::get('/job', [EmployeeJobController::class , 'index']);

// Province
Route::get('/province', [ProvinceController::class , 'index']);

// City
Route::get('/city', [CityController::class , 'index']);

// District
Route::get('/district', [DistrictController::class , 'index']);

// Village
Route::get('/village', [VillageController::class , 'index']);

// Setting
Route::get('/setting', [SettingController::class , 'index']);

// Leave Request
Route::get('/leave-request', [LeaveRequestController::class , 'index']);