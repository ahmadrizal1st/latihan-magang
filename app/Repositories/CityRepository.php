<?php

namespace App\Repositories;

use App\Interfaces\CityRepositoryInterface;
use App\Models\City;

class CityRepository implements CityRepositoryInterface
{
    public function __construct(
        private City $model
    ) {}

    public function getAll()
    {
        return $this->model->with("employees");
    }

    public function search(string $keyword) 
    {
        return City::whereLike('name',"%{$keyword}%")
            ->select('id', 'name')
            ->orderBy('name')
            ->get();
    }

    public function create(array $data){
        return $this->model->create($data);
    }

    public function update($id, array $data){
        $city = $this->model->findOrFail($id);
        $city->update($data);
        return $city;    }

    public function delete($id){
        return $this->model->destroy($id);
    }
}