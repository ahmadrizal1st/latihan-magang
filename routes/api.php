<?php

use App\Http\Controllers\Api\EmployeeController;
use Illuminate\Support\Facades\Route;


Route::get('/employee', action: [EmployeeController::class, 'index']);