<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private User $model
    ) {}

    /**
     * Get all users with their related data.
     */
    public function getAll()
    {
        return $this->model->query();
    }

    /**
     * Search users by name.
     */
    public function search(string $keyword, ?int $districtId = null) 
    {
        return $this->model->when($districtId, fn($q) => $q->where('district_id', $districtId))
            ->when($keyword, fn($q) => $q->whereLike('name', "%{$keyword}%"))
            ->select('id', 'name')
            ->orderBy('name')
            ->limit(50)
            ->get();
    }

    /**
     * Create a new user record.
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing user record by ID.
     */
    public function update($id, array $data)
    {
        $user = $this->model->findOrFail($id);
        $user->update($data);
        return $user;
    }

    /**
     * Delete a user record by ID.
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}