<?php

namespace App\Interfaces;

interface LeaveRequestRepositoryInterface
{
    /**
     * Get all leave requests with their related data.
     */
    public function getAll();

    /**
     * Get by ID leave request with related data.
     */
    public function getById($id);

    /**
     * Create a new leave request record.
     */
    public function create(array $data);

    /**
     * Update an existing leave request record by ID.
     */
    public function update($id, array $data);

    /**
     * Delete a leave request record by ID.
     */
    public function delete($id);
}