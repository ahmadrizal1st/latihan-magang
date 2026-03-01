<?php

namespace App\Interfaces;

interface EmployeeRepositoryInterface
{
    /**
     * Get all employees with their related data.
     */
    public function getAll();

    /**
     * Find by id employees with their related data.
     */
    public function findById($id);

    /**
     * Search employees by name or NIP.
     */
    public function search(string $keyword);

    /**
     * Create a new employee record.
     */
    public function create(array $data);

    /**
     * Update an existing employee record by ID.
     */
    public function update($id, array $data);

    /**
     * Delete an employee record by ID.
     */
    public function delete($id);
}