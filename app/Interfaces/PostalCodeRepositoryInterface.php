<?php

namespace App\Interfaces;

interface PostalCodeRepositoryInterface
{
    /**
     * Get all postal codes with their related data.
     */
    public function getAll();

    /**
     * Search postal codes by name.
     */
    public function search(string $keyword);

    /**
     * Create a new postal code record.
     */
    public function create(array $data);

    /**
     * Update an existing postal code record by ID.
     */
    public function update($id, array $data);

    /**
     * Delete an postal code record by ID.
     */
    public function delete($id);
}