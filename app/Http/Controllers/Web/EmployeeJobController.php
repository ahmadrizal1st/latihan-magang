<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;


class EmployeeJobController extends Controller
{
    public function index()
    {
        return view('employee-jobs.index');
    }
}