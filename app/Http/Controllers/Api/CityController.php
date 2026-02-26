<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\CityRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;


class CityController extends Controller
{
    public function __construct(
        private CityRepositoryInterface $cityRepository
    ) {}
    
    public function index()
    {
        $cities = $this->cityRepository->getAll();

        return DataTables::of($cities)
        ->addIndexColumn()
        ->toJson();
    }
}