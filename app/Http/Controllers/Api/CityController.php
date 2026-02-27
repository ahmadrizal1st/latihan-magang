<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\UpdateCityRequest;
use App\Http\Requests\City\StoreCityRequest;
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

    public function store(StoreCityRequest $request)
    {
        $city = $this->cityRepository->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kota berhasil ditambahkan.',
            'data'    => $city,
        ], 201);
    }

    public function update(UpdateCityRequest $request, $id)
    {
        $city = $this->cityRepository->update($id, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kota berhasil diperbarui.',
            'data'    => $city,
        ]);
    }

    public function destroy($id)
    {
        $this->cityRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Kota berhasil dihapus.',
        ]);
    }
}