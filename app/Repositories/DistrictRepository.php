<?php

namespace App\Repositories;

use App\Interfaces\DistrictRepositoryInterface;
use App\Models\District;

class DistrictRepository implements DistrictRepositoryInterface
{
    public function __construct(
        private District $model
    ) {}

    /**
     * Get all districts with their related data.
     */
    public function getAll()
    {
        return District::with('city')
            ->withCount(['villages', 'employees']);
    }

    /**
     * Search districts by name.
     */
    public function search(string $keyword, ?int $cityId = null) 
    {
        return District::when($cityId, fn($q) => $q->where('city_id', $cityId))
            ->when($keyword, fn($q) => $q->whereLike('name', "%{$keyword}%"))
            ->select('id', 'name')
            ->orderBy('name')
            ->limit(50)
            ->get();
    }

    /**
     * Create a new district record.
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing district record by ID.
     */
    public function update($id, array $data)
    {
        $district = $this->model->findOrFail($id);
        $district->update($data);
        return $district;
    }

    /**
     * Delete a district record by ID.
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}