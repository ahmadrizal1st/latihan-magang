<?php

namespace App\Interfaces;

interface SettingRepositoryInterface
{
    /**
     * Get by ID settings with their related data.
     */
    public function getById();
    
    /**
     * Update an existing setting record by ID.
     */
    public function update(array $data);
}