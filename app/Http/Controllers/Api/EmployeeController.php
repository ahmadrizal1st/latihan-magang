<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
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

    public function store(StoreEmployeeRequest $request)
    {
        $employee = $this->employeeRepository->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Karyawan berhasil ditambahkan.',
            'data'    => $employee,
        ], 201);
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {
        $employee = $this->employeeRepository->update($id, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Karyawan berhasil diperbarui.',
            'data'    => $employee,
        ]);
    }

    public function destroy($id)
    {
        $this->employeeRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Karyawan berhasil dihapus.',
        ]);
    }
}