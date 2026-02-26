<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\EmployeeRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function __construct(
        private EmployeeRepositoryInterface $employeeRepository
    ) {}
    
    public function index()
    {
        $employees = $this->employeeRepository->getAll();

        return DataTables::of($employees)
        ->addIndexColumn()
        ->addColumn('city', fn($employee): string => $employee->city->name ?? '-')
        ->addColumn('employee_job', fn($employee): string => $employee->employeeJob->name ?? '-')
        ->toJson();
    }
}