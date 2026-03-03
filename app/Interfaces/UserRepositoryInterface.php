<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    /**
     * Get all UserRepositoryInterfaces records with related data.
     */
    public function getAll();

    /**
     * Search UserRepositoryInterfaces by keyword.
     */
    public function search(string $keyword);

    /**
     * Create a new UserRepositoryInterface record.
     */
    public function create(array $data);

    /**
     * Update an existing UserRepositoryInterface record by ID.
     */
    public function update($id, array $data);

    /**
     * Delete a UserRepositoryInterface record by ID.
     */
    public function delete($id);
}
