<?php

namespace App\Interfaces;

interface DistrictRepositoryInterface
{
    /**
     * Get all districts with their related data.
     */
    public function getAll();

    /**
     * Search districts by name.
     */
    public function search(string $keyword, ?int $cityId = null);

    /**
     * Create a new district record.
     */
    public function create(array $data);

    /**
     * Update an existing district record by ID.
     */
    public function update($id, array $data);

    /**
     * Delete an district record by ID.
     */
    public function delete($id);
}