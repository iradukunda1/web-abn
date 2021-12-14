<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BussinessCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "merchants" => $this->merchants->count(),
            "status" => $this->status,
            "created_at" => $this->created_at->toDateString()
        ];
    }
}
