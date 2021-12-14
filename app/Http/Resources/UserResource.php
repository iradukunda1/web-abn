<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "phone_number" => $this->phone_number,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "country" => $this->country,
            "verified"=> $this->verified,
            "email" => $this->email,
            "role" => $this->roles->first()->name,
            "role_id" => $this->roles->first()->id,
            "active" => $this->active,
            "created_at" => $this->created_at->toDateString(),
        ];

    }
}
