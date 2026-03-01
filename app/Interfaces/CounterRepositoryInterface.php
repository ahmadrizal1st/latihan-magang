<?php

namespace App\Interfaces;

interface CounterRepositoryInterface
{
    /**
     * Get all counters with their related data.
     */
    public function getAll();

    /**
     * Search counters by name.
     */
    public function search(string $keyword);

    /**
     * Create a new counter record.
     */
    public function create(array $data);

    /**
     * Update an existing counter record by ID.
     */
    public function update($id, array $data);

    /**
     * Delete an counter record by ID.
     */
    public function delete($id);
}