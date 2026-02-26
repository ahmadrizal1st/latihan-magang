<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Jika menggunakan Yajra datatables maka resource sudah tidak digunakan
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'city'       => $this->city,
            'job'        => $this->job,
        ];
    }
}