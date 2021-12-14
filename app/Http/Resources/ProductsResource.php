<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
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
            "title" => $this->title,
            "price" => $this->price,
            "sale_price"=>$this->sale_price,
            "quantity" => $this->quantity,
            "tags" => json_decode($this->tags),
            "images" => $this->images,
            "seller" => $this->seller,
            "description" => $this->description,
            "categories" => $this->categories,
            "slug" => $this->slug,
            "created_at" => $this->created_at->toDateString()
        ];
    }
}
