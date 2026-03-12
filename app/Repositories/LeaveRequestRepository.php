<?php

namespace App\Repositories;

use App\Interfaces\LeaveRequestRepositoryInterface;
use App\Models\LeaveRequest;

class LeaveRequestRepository implements LeaveRequestRepositoryInterface
{
    public function __construct(
        private LeaveRequest $model
        )
    {
    }

    /**
     * Get all leave requests with their related data.
     */
    public function getAll()
    {
        return $this->model->with(['employee']);
    }

    /**
     * Get by id leave request with related data.
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Create a new leave request record.
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing leave request record by ID.
     */
    public function update($id, array $data)
    {
        $leaveRequest = $this->model->findOrFail($id);
        $leaveRequest->update($data);
        return $leaveRequest;
    }

    /**
     * Delete a leave request record by ID.
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}