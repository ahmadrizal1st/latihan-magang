<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('datatable')) {
            $users = $this->userRepository->getAll();

            return DataTables::of($users)
                ->addIndexColumn()
                ->toJson();
        }

        $keyword = '';
        if ($request->has('search')) {
            $keyword = is_array($request->search)
                ? $request->search['term'] ?? ''
                : $request->search ?? '';
        }

        $users = $this->userRepository->search($keyword);

        return response()->json([
            'results' => $users->map(fn($user) => [
                'id'   => $user->id,
                'text' => $user->name . ' - ' . $user->email,
            ]),
            'pagination' => [
                'more' => false
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userRepository->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'User berhasil ditambahkan.',
            'data'    => $user,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userRepository->update($id, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'User berhasil diperbarui.',
            'data'    => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->userRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus.',
        ]);
    }
}