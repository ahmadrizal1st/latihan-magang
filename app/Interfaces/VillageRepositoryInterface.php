<?php

namespace App\Interfaces;

interface VillageRepositoryInterface
{
    /**
     * Get all villages with their related data.
     */
    public function getAll();

    /**
     * Search villages by name.
     */
    public function search(string $keyword, ?int $districtId = null);

    /**
     * Create a new village record.
     */
    public function create(array $data);

    /**
     * Update an existing village record by ID.
     */
    public function update($id, array $data);

    /**
     * Delete an village record by ID.
     */
    public function delete($id);
}