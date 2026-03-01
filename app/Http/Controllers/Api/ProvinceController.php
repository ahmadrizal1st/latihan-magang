<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Province\StoreProvinceRequest;
use App\Http\Requests\Province\UpdateProvinceRequest;
use App\Interfaces\ProvinceRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProvinceController extends Controller
{
    public function __construct(
        private ProvinceRepositoryInterface $provinceRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('datatable')) {
            $provinces = $this->provinceRepository->getAll();

            return DataTables::of($provinces)
                ->addIndexColumn()
                ->addColumn('cities_count',    fn($p) => $p->cities_count)
                ->addColumn('districts_count', fn($p) => $p->districts_count)
                ->addColumn('villages_count',  fn($p) => $p->villages_count)
                ->addColumn('employees_count', fn($p) => $p->employees_count)
                ->toJson();
        }

        $keyword = '';
        if ($request->has('search')) {
            $keyword = is_array($request->search)
                ? $request->search['term'] ?? ''
                : $request->search ?? '';
        }

        $provinces = $this->provinceRepository->search($keyword);

        return response()->json([
            'results' => $provinces->map(fn($province) => [
                'id'   => $province->id,
                'text' => $province->name,
            ]),
            'pagination' => [
                'more' => false
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProvinceRequest $request)
    {
        $province = $this->provinceRepository->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Provinsi berhasil ditambahkan.',
            'data'    => $province,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProvinceRequest $request, $id)
    {
        $province = $this->provinceRepository->update($id, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Provinsi berhasil diperbarui.',
            'data'    => $province,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->provinceRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Provinsi berhasil dihapus.',
        ]);
    }
}