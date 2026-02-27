<?php

namespace App\Interfaces;

interface CityRepositoryInterface
{
    public function getAll();
    
    public function create(array $data);

    public function search(string $keyword);

    public function update($id, array $data);

    public function delete($id);
}