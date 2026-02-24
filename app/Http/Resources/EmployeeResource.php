<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'city'       => $this->city,
            'job'        => $this->job,
            'created_at' => $this->created_at->format('d M Y'),
        ];
    }
}