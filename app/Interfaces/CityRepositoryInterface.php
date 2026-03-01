<?php

namespace App\Interfaces;

interface CityRepositoryInterface
{
    /**
     * Get all cities with their related data.
     */
    public function getAll();

    /**
     * Search cities by name.
     */
    public function search(string $keyword, ?int $provinceId = null);

    /**
     * Create a new city record.
     */
    public function create(array $data);

    /**
     * Update an existing city record by ID.
     */
    public function update($id, array $data);

    /**
     * Delete an city record by ID.
     */
    public function delete($id);
}