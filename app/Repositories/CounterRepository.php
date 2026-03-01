<?php

namespace App\Repositories;

use App\Interfaces\CounterRepositoryInterface;
use App\Models\Counter;

class CounterRepository implements CounterRepositoryInterface
{
    public function __construct(
        private Counter $model
    ) {}

    /**
     * Get all counters.
     */
    public function getAll()
    {
        return $this->model->query();
    }

    public function search(string $keyword) 
    {
        return Counter::whereLike('name', "%{$keyword}%")
            ->select('id', 'code')
            ->orderBy('code')
            ->limit(50)
            ->get();
    }

    /**
     * Create a new counter record.
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing counter record by ID.
     */
    public function update($id, array $data)
    {
        $counter = $this->model->findOrFail($id);
        $counter->update($data);
        return $counter;
    }

    /**
     * Delete a counter record by ID.
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}