<?php

namespace App\Repositories;

use App\Interfaces\PostalCodeRepositoryInterface;
use App\Models\PostalCode;

class PostalCodeRepository implements PostalCodeRepositoryInterface
{
    public function __construct(
        private PostalCode $model
    ) {}

    /**
     * Get all postal codes with their related data.
     */
    public function getAll()
    {
        return $this->model->withCount('employees');
    }

    /**
     * Search postal codes by name.
     */
    public function search(string $keyword)
    {
        return PostalCode::whereLike('name', "%{$keyword}%")
            ->select('id', 'name')
            ->orderBy('name')
            ->limit(50)
            ->get();
    }

    /**
     * Create a new postal code record.
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing postal code record by ID.
     */
    public function update($id, array $data)
    {
        $postalCode = $this->model->findOrFail($id);
        $postalCode->update($data);
        return $postalCode;
    }

    /**
     * Delete a postal code record by ID.
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}