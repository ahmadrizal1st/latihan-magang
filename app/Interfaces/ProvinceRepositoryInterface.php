<?php

namespace App\Interfaces;

interface ProvinceRepositoryInterface
{
    /**
     * Get all provinces with their related data.
     */
    public function getAll();

    /**
     * Search provinces by name or NIP.
     */
    public function search(string $keyword);

    /**
     * Create a new province record.
     */
    public function create(array $data);

    /**
     * Update an existing province record by ID.
     */
    public function update($id, array $data);

    /**
     * Delete an province record by ID.
     */
    public function delete($id);
}