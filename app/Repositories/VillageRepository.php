<?php

namespace App\Repositories;

use App\Interfaces\VillageRepositoryInterface;
use App\Models\Village;

class VillageRepository implements VillageRepositoryInterface
{
    public function __construct(
        private Village $model
    ) {}

    /**
     * Get all villages with their related data.
     */
    public function getAll()
    {
        return Village::with('district')
            ->withCount(['employees']);
    }

    /**
     * Search villages by name.
     */
    public function search(string $keyword, ?int $districtId = null) 
    {
        return Village::when($districtId, fn($q) => $q->where('district_id', $districtId))
            ->when($keyword, fn($q) => $q->whereLike('name', "%{$keyword}%"))
            ->select('id', 'name')
            ->orderBy('name')
            ->limit(50)
            ->get();
    }

    /**
     * Create a new village record.
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing village record by ID.
     */
    public function update($id, array $data)
    {
        $village = $this->model->findOrFail($id);
        $village->update($data);
        return $village;
    }

    /**
     * Delete a village record by ID.
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}