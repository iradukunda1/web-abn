<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "quantity" => $this->quantity,
            "price" => $this->price,
            "product" => $this->product->title,
            "tags"=>json_decode($this->product->tags),
            "product_image" => $this->product->product_image,
            "created_at" => $this->created_at->toDateString(),
        ];
    }
}
