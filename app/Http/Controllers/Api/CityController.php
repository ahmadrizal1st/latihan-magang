<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\StoreCityRequest;
use App\Http\Requests\City\UpdateCityRequest;
use App\Interfaces\CityRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{

    public function __construct(
        private CityRepositoryInterface $cityRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('datatable')) {
            $cities = $this->cityRepository->getAll();

            return DataTables::of($cities)
                ->addIndexColumn()
                ->addColumn('province_name',   fn($c) => $c->province?->name ?? '-')
                ->addColumn('province_id',     fn($c) => $c->province_id)
                ->addColumn('districts_count', fn($c) => $c->districts_count)
                ->addColumn('villages_count',  fn($c) => $c->villages_count)
                ->addColumn('employees_count', fn($c) => $c->employees_count)
                ->toJson();
        }

        $keyword = '';
        if ($request->has('search')) {
            $keyword = is_array($request->search)
                ? $request->search['term'] ?? ''
                : $request->search ?? '';
        }

        $provinceId = $request->province_id ?? null;

        $cities = $this->cityRepository->search($keyword, $provinceId);

        return response()->json([
            'results' => $cities->map(fn($city) => [
                'id'   => $city->id,
                'text' => $city->name,
            ]),
            'pagination' => [
                'more' => false
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request)
    {
        $city = $this->cityRepository->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kota berhasil ditambahkan.',
            'data'    => $city,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, $id)
    {
        $city = $this->cityRepository->update($id, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kota berhasil diperbarui.',
            'data'    => $city,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->cityRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Kota berhasil dihapus.',
        ]);
    }
}