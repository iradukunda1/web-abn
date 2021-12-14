<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "products" => $this->products->count(),
            "status" => $this->status,
            "created_at" => $this->created_at->toDateString()
        ];
    }
}
