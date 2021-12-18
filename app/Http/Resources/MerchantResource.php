<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MerchantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "phone_number" => $this->phone_number,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "bussiness_name" => $this->bussiness_name,
            "bussiness_category_id" => $this->bussiness_category_id,
            "tin_number" => $this->tin_number,
            "registered_by" => $this->registered_by,
            "country" => $this->country,
            "province" => $this->province,
            "district" => $this->district,
            "sector" => $this->sector,
            "cell" => $this->cell,
            "village" => $this->village,
            "avatar" => $this->avatar,
            "verified"=> $this->verified,
            "active"=> $this->active,
            "description"=> $this->description,
            "created_at" => $this->created_at->toDateString(),
        ];
    }
}
