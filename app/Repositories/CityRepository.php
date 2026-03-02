<?php

namespace App\Repositories;

use App\Interfaces\CityRepositoryInterface;
use App\Models\City;

class CityRepository implements CityRepositoryInterface
{
    public function __construct(
        private City $model
    ) {}

    /**
     * Get all cities with their related data.
     */
    public function getAll()
    {
        return $this->model->with('province')
            ->withCount('employees');
    }

    /**
     * Search cities by name.
     */
    public function search(string $keyword, ?int $provinceId = null) 
    {
        return $this->model->when($provinceId, fn($q) => $q->where('province_id', $provinceId))
            ->when($keyword, fn($q) => $q->whereLike('name', "%{$keyword}%"))
            ->select('id', 'name')
            ->orderBy('name')
            ->limit(50)
            ->get();
    }

    /**
     * Create a new city record.
     */
    public function create(array $data){
        return $this->model->create($data);
    }

    /**
     * Update an existing city record by ID.
     */
    public function update($id, array $data){
        $city = $this->model->findOrFail($id);
        $city->update($data);
        return $city;
    }

    /**
     * Delete a city record by ID.
     */
    public function delete($id){
        return $this->model->destroy($id);
    }
}