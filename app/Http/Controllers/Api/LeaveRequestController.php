<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveRequest\StoreLeaveRequestRequest;
use App\Http\Requests\LeaveRequest\UpdateLeaveRequestRequest;
use App\Interfaces\LeaveRequestRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LeaveRequestController extends Controller
{
    public function __construct(
        private LeaveRequestRepositoryInterface $leaveRequestRepository
        )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('datatable')) {
            $leaveRequests = $this->leaveRequestRepository->getAll();

            return DataTables::of($leaveRequests)
                ->addIndexColumn()
                ->addColumn('employee_name', fn($leaveRequest): string => $leaveRequest->employee->name ?? '-')
                ->addColumn('employee_nip', fn($leaveRequest): string => $leaveRequest->employee->nip ?? '-')
                ->toJson();
        }

        return response()->json(['results' => []]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeaveRequestRequest $request)
    {
        $data = $request->validated();

        $leaveRequest = $this->leaveRequestRepository->create($data);

        return response()->json([
            'success' => true,
            'message' => 'Cuti berhasil ditambahkan.',
            'data' => $leaveRequest,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaveRequestRequest $request, $id)
    {
        $data = $request->validated();

        $leaveRequest = $this->leaveRequestRepository->update($id, $data);

        return response()->json([
            'success' => true,
            'message' => 'Cuti berhasil diperbarui.',
            'data' => $leaveRequest,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->leaveRequestRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Cuti berhasil dihapus.',
        ]);
    }
}