<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Services\NipService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function __construct(
        private EmployeeRepositoryInterface $employeeRepository,
        private NipService $nipService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('datatable')) {
            $employees = $this->employeeRepository->getAll();

            return DataTables::of($employees)
                ->addIndexColumn()
                ->addColumn('employee_job_name', fn($employee): string => $employee->employeeJob->name ?? '-')
                ->addColumn('province_name', fn($employee): string => $employee->province->name ?? '-')
                ->addColumn('city_name', fn($employee): string => $employee->city->name ?? '-')
                ->addColumn('district_name', fn($employee): string => $employee->district->name ?? '-')
                ->addColumn('village_name', fn($employee): string => $employee->village->name ?? '-')
                ->addColumn('postal_code_name', fn($employee): string => $employee->postalCode->name ?? '-')
                ->addColumn('photo_url', fn($employee): string => $employee->photo
                    ? Storage::url($employee->photo)
                    : asset('images/default-avatar.png')
                )
                ->toJson();
        }

        if ($request->has('search')) {
            $keyword = is_array($request->search)
                ? $request->search['term'] ?? ''
                : $request->search ?? '';

            $employees = $this->employeeRepository->search($keyword);

            return response()->json([
                'results' => $employees->map(fn($employee) => [
                    'id'   => $employee->id,
                    'text' => $employee->name . ' - ' . $employee->nip,
                ])
            ]);
        }

        return response()->json(['results' => []]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $data = $request->validated();

        $data['nip'] = $this->nipService->generate($data['date_of_birth']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('employees/photos', 'public');
        }

        $employee = $this->employeeRepository->create($data);

        return response()->json([
            'success' => true,
            'message' => 'Karyawan berhasil ditambahkan.',
            'data'    => $employee,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $data = $request->validated();

        $employee = $this->employeeRepository->findById($id);

        if (empty($employee->nip) && !empty($data['date_of_birth'])) {
            $data['nip'] = $this->nipService->generate($data['date_of_birth']);
        }

        if ($request->hasFile('photo')) {
            if ($employee->photo) {
                Storage::disk('public')->delete($employee->photo);
            }
            $data['photo'] = $request->file('photo')->store('employees/photos', 'public');
        }

        $employee = $this->employeeRepository->update($id, $data);

        return response()->json([
            'success' => true,
            'message' => 'Karyawan berhasil diperbarui.',
            'data'    => $employee,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = $this->employeeRepository->findById($id);

        if ($employee->photo) {
            Storage::disk('public')->delete($employee->photo);
        }

        $this->employeeRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Karyawan berhasil dihapus.',
        ]);
    }
}