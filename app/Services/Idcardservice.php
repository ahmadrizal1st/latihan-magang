<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class IdCardService
{
    /**
     * Generate PDF ID Card untuk satu karyawan.
     */
    public function generateSingle(Employee $employee)
    {
        $data = $this->prepareEmployeeData($employee);
        $settings = Setting::first();

        $pdf = Pdf::loadView('pdf.id-card', [
            'employees' => collect([$data]),
            'settings'  => $settings,
            ])
            ->setPaper([0, 0, 242.65, 153.07], 'landscape');

        return $pdf->download("id-card-{$employee->nip}.pdf");
    }

    /**
     * Generate PDF ID Card bulk — semua karyawan dalam satu file.
     */
    public function generateBulk(Collection $employees)
    {
        $data = $employees->map(fn($e) => $this->prepareEmployeeData($e));
        $settings = Setting::first();

        $pdf = Pdf::loadView('pdf.id-card', [
            'employees' => $data,
            'settings'  => $settings,
            ])
            ->setPaper([0, 0, 242.65, 153.07], 'landscape');

        return $pdf->download('id-card-bulk-' . now()->format('YmdHis') . '.pdf');
    }

    /**
     * Siapkan data karyawan termasuk photo base64.
     */
    private function prepareEmployeeData(Employee $employee)
    {
        // Photo → base64
        $photoBase64 = null;
        if ($employee->photo && Storage::disk('public')->exists($employee->photo)) {
            $content     = Storage::disk('public')->get($employee->photo);
            $fullPath    = Storage::disk('public')->path($employee->photo);
            $mime        = mime_content_type($fullPath) ?: 'image/jpeg';
            $photoBase64 = 'data:' . $mime . ';base64,' . base64_encode($content);
        }

        $nip        = $employee->nip ?? '000000000000000';

        return [
            'nip'            => $nip,
            'name'           => $employee->name,
            'place_of_birth' => $employee->place_of_birth ?? '-',
            'date_of_birth'  => $employee->date_of_birth
                ? Carbon::parse($employee->date_of_birth)->format('d/m/Y')
                : '-',
            'province'       => $employee->province->name  ?? '-',
            'city'           => $employee->city->name      ?? '-',
            'district'       => $employee->district->name  ?? '-',
            'village'        => $employee->village->name   ?? '-',
            'post_code'      => $employee->post_code       ?? '-',
            'job'            => $employee->employeeJob->name ?? '-',
            'photo_base64'   => $photoBase64,
        ];
    }
}