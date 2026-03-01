<?php

namespace App\Repositories;

use App\Interfaces\ProvinceRepositoryInterface;
use App\Models\Province;

class ProvinceRepository implements ProvinceRepositoryInterface
{
    public function __construct(
        private Province $model
    ) {}

    /**
     * Get all provinces with their related data.
     */
    public function getAll()
    {
        return Province::withCount(['cities', 'districts', 'villages', 'employees']);
    }

    /**
     * Search provinces by name.
     */
    public function search(string $keyword)
    {
        return Province::whereLike('name', "%{$keyword}%")
            ->select('id', 'name')
            ->orderBy('name')
            ->limit(50)
            ->get();
    }

    /**
     * Create a new province record.
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing province record by ID.
     */
    public function update($id, array $data)
    {
        $province = $this->model->findOrFail($id);
        $province->update($data);
        return $province;
    }

    /**
     * Delete a province record by ID.
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}