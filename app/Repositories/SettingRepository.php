<?php

namespace App\Repositories;

use App\Interfaces\SettingRepositoryInterface;
use App\Models\Setting;

class SettingRepository implements SettingRepositoryInterface
{
    public function __construct(
        private Setting $model
    ) {}

    /**
     * Get setting with related province, city, district, village.
     */
    public function getById(): Setting
    {
        return $this->model
            ->with(['province', 'city', 'district', 'village'])
            ->first();
    }

    /**
     * Update setting record.
     */
    public function update(array $data)
    {
        $setting = $this->model->first();
        $setting->update($data);
        return $setting->load(['province', 'city', 'district', 'village']);
    }
}