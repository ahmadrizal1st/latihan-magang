<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\UpdateSettingRequest;
use App\Interfaces\SettingRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __construct(
        private SettingRepositoryInterface $settingRepository
    ) {}

    /**
     * Display the setting.
     */
    public function show()
    {
        $setting = $this->settingRepository->getById();

        return response()->json([
            'data' => $setting
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('company_logo')) {
            $setting = $this->settingRepository->getById();

            if ($setting->company_logo && Storage::disk('public')->exists($setting->company_logo)) {
                Storage::disk('public')->delete($setting->company_logo);
            }

            $data['company_logo'] = $request->file('company_logo')->store('logo', 'public');
        }

        $setting = $this->settingRepository->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Setting berhasil diperbarui.',
            'data'    => $setting,
        ]);
    }
}