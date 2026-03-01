<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Village\StoreVillageRequest;
use App\Http\Requests\Village\UpdateVillageRequest;
use App\Interfaces\VillageRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VillageController extends Controller
{
    public function __construct(
        private VillageRepositoryInterface $villageRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('datatable')) {
            $villages = $this->villageRepository->getAll();

            return DataTables::of($villages)
                ->addIndexColumn()
                ->addColumn('district_name',   fn($v) => $v->district?->name ?? '-')
                ->addColumn('district_id',     fn($v) => $v->district_id)
                ->addColumn('employees_count', fn($v) => $v->employees_count)
                ->toJson();
        }

        $keyword = '';
        if ($request->has('search')) {
            $keyword = is_array($request->search)
                ? $request->search['term'] ?? ''
                : $request->search ?? '';
        }

        $districtId = $request->district_id ?? null;

        $villages = $this->villageRepository->search($keyword, $districtId);

        return response()->json([
            'results' => $villages->map(fn($village) => [
                'id'   => $village->id,
                'text' => $village->name,
            ]),
            'pagination' => [
                'more' => false
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVillageRequest $request)
    {
        $village = $this->villageRepository->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Desa/kelurahan berhasil ditambahkan.',
            'data'    => $village,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVillageRequest $request, $id)
    {
        $village = $this->villageRepository->update($id, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Desa/kelurahan berhasil diperbarui.',
            'data'    => $village,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->villageRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Desa/kelurahan berhasil dihapus.',
        ]);
    }
}