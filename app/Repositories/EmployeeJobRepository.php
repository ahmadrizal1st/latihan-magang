<?php

namespace App\Repositories;

use App\Interfaces\EmployeeJobRepositoryInterface;
use App\Models\EmployeeJob;

class EmployeeJobRepository implements EmployeeJobRepositoryInterface
{
    public function __construct(
        private EmployeeJob $model
    ) {}

    /**
     * Get all employee jobs with their related data.
     */
    public function getAll()
    {
        return $this->model->with("employees");
    }

    /**
     * Search employee jobs by name.
     */
    public function search(string $keyword) 
    {
        return EmployeeJob::whereLike('name', "%{$keyword}%")
            ->select('id', 'name')
            ->orderBy('name')
            ->limit(50)
            ->get();
    }

    /**
     * Create a new employee job record.
     */
    public function create(array $data){
        return $this->model->create($data);
    }

    /**
     * Update an existing employee job record by ID.
     */
    public function update($id, array $data){
        $emoployeeJob = $this->model->findOrFail($id);
        $emoployeeJob->update($data);
        return $emoployeeJob;
    }

    /**
     * Delete an employee job record by ID.
     */
    public function delete($id){
        return $this->model->destroy($id);
    }
}