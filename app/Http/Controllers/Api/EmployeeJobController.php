<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\EmployeeJobRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;


class EmployeeJobController extends Controller
{
    public function __construct(
        private EmployeeJobRepositoryInterface $employeeJobRepository
    ) {}

    public function index()
    {
        $employeeJobs = $this->employeeJobRepository->getAll();

        return DataTables::of($employeeJobs)
        ->addIndexColumn()
        ->toJson();
    }
}