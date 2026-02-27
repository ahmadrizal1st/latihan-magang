<?php

namespace App\Repositories;

use App\Interfaces\EmployeeJobRepositoryInterface;
use App\Models\EmployeeJob;

class EmployeeJobRepository implements EmployeeJobRepositoryInterface
{
    public function __construct(
        private EmployeeJob $model
    ) {}

    public function getAll()
    {
        return $this->model->with("employees");
    }

    public function create(array $data){
        return $this->model->create($data);
    }

    public function update($id, array $data){
        $emoployeeJob = $this->model->findOrFail($id);
        $emoployeeJob->update($data);
        return $emoployeeJob;
    }

    public function delete($id){
        return $this->model->destroy($id);
    }
}