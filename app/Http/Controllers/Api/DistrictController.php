<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\District\StoreDistrictRequest;
use App\Http\Requests\District\UpdateDistrictRequest;
use App\Interfaces\DistrictRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DistrictController extends Controller
{
    public function __construct(
        private DistrictRepositoryInterface $districtRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('datatable')) {
            $districts = $this->districtRepository->getAll();

            return DataTables::of($districts)
                ->addIndexColumn()
                ->addColumn('city_name',       fn($d) => $d->city?->name ?? '-')
                ->addColumn('city_id',         fn($d) => $d->city_id)
                ->addColumn('villages_count',  fn($d) => $d->villages_count)
                ->addColumn('employees_count', fn($d) => $d->employees_count)
                ->toJson();
        }

        $keyword = '';
        if ($request->has('search')) {
            $keyword = is_array($request->search)
                ? $request->search['term'] ?? ''
                : $request->search ?? '';
        }

        $cityId = $request->city_id ?? null;

        $districts = $this->districtRepository->search($keyword, $cityId);

        return response()->json([
            'results' => $districts->map(fn($district) => [
                'id'   => $district->id,
                'text' => $district->name,
            ]),
            'pagination' => [
                'more' => false
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDistrictRequest $request)
    {
        $district = $this->districtRepository->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kecamatan berhasil ditambahkan.',
            'data'    => $district,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDistrictRequest $request, $id)
    {
        $district = $this->districtRepository->update($id, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kecamatan berhasil diperbarui.',
            'data'    => $district,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->districtRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Kecamatan berhasil dihapus.',
        ]);
    }
}