<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Counter\StoreCounterRequest;
use App\Http\Requests\Counter\UpdateCounterRequest;
use App\Interfaces\CounterRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CounterController extends Controller
{
    public function __construct(
        private CounterRepositoryInterface $counterRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('datatable')) {
            $counters = $this->counterRepository->getAll();

            return DataTables::of($counters)
                ->addIndexColumn()
                ->toJson();
        }

        if ($request->has('search')) {
            $keyword = is_array($request->search)
                ? $request->search['term'] ?? ''
                : $request->search ?? '';

            $counters = $this->counterRepository->search($keyword);

            return response()->json([
                'results' => $counters->map(fn($counter) => [
                    'id'   => $counter->id,
                    'text' => $counter->code,
                ])
            ]);
        }

        return response()->json(['results' => []]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCounterRequest $request)
    {
        $counter = $this->counterRepository->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Counter berhasil ditambahkan.',
            'data'    => $counter,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCounterRequest $request, $id)
    {
        $counter = $this->counterRepository->update($id, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Counter berhasil diperbarui.',
            'data'    => $counter,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->counterRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Counter berhasil dihapus.',
        ]);
    }
}