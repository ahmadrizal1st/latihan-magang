<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class EmployeeJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employee-jobs.index');
    }
}