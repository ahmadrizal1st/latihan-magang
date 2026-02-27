<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeJob\StoreEmployeeJobRequest;
use App\Http\Requests\EmployeeJob\UpdateEmployeeJobRequest;
use App\Interfaces\EmployeeJobRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeJobController extends Controller
{
    public function __construct(
        private EmployeeJobRepositoryInterface $employeeJobRepository
    ) {}

    public function index(Request $request)
    {
        // Jika ada parameter datatable → request dari DataTables
        if ($request->has('datatable')) {
            $employeeJobs = $this->employeeJobRepository->getAll();

            return DataTables::of($employeeJobs)
                ->addIndexColumn()
                ->addColumn('employees', function ($employeeJob) {
                    return $employeeJob->employees->toArray();
                })
                ->toJson();
        }

        // Jika ada parameter search → request dari Select2 AJAX
        if ($request->has('search')) {
            $keyword = is_array($request->search)
                ? $request->search['term'] ?? ''
                : $request->search ?? '';

            $employeeJobs = $this->employeeJobRepository->search($keyword);

            return response()->json([
                'results' => $employeeJobs->map(fn($employeeJob) => [
                    'id'   => $employeeJob->id,
                    'text' => $employeeJob->name,
                ])
            ]);
        }

        return response()->json(['results' => []]);
    }

    public function store(StoreEmployeeJobRequest $request)
    {
        $employeeJob = $this->employeeJobRepository->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Pekerjaan berhasil ditambahkan.',
            'data'    => $employeeJob,
        ], 201);
    }

    public function update(UpdateEmployeeJobRequest $request, $id)
    {
        $employeeJob = $this->employeeJobRepository->update($id, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Pekerjaan berhasil diperbarui.',
            'data'    => $employeeJob,
        ]);
    }

    public function destroy($id)
    {
        $this->employeeJobRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Pekerjaan berhasil dihapus.',
        ]);
    }
}