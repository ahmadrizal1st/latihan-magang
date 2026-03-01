<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostalCode\StorePostalCodeRequest;
use App\Http\Requests\PostalCode\UpdatePostalCodeRequest;
use App\Interfaces\PostalCodeRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PostalCodeController extends Controller
{
    public function __construct(
        private PostalCodeRepositoryInterface $postalCodeRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('datatable')) {
            $postalCodes = $this->postalCodeRepository->getAll();

            return DataTables::of($postalCodes)
                ->addIndexColumn()
                ->addColumn('employees_count',  fn($c) => $c->employees_count)
                ->toJson();
        }

        if ($request->has('search')) {
            $keyword = is_array($request->search)
                ? $request->search['term'] ?? ''
                : $request->search ?? '';

            $postalCodes = $this->postalCodeRepository->search($keyword);

            return response()->json([
                'results' => $postalCodes->map(fn($postalCode) => [
                    'id'   => $postalCode->id,
                    'text' => $postalCode->name,
                ])
            ]);
        }

        return response()->json(['results' => []]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostalCodeRequest $request)
    {
        $postalCode = $this->postalCodeRepository->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kode pos berhasil ditambahkan.',
            'data'    => $postalCode,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostalCodeRequest $request, $id)
    {
        $postalCode = $this->postalCodeRepository->update($id, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kode pos berhasil diperbarui.',
            'data'    => $postalCode,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->postalCodeRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Kode pos berhasil dihapus.',
        ]);
    }
}