<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CityResource;
use App\Http\Controllers\Controller;
use App\Interfaces\CityRepositoryInterface;

class CityController extends Controller
{
    public function __construct(
        private CityRepositoryInterface $employeeRepository
    ) {}
    
    public function index()
    {
        $employees = $this->employeeRepository->getAll();

        return CityResource::collection($employees)
            ->additional(['status' => 'success']);
    }
}