<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $appends = ["product_image"];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $slug = Str::slug($product->title);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $product->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }
    public function getProductImageAttribute()
    {
        if ($this->images && json_decode($this->images)) {
            return json_decode($this->images)[0];
        }
        return "/img/no-image.jpg";
    }
    public function creator()
    {
        return $this->belongsTo(User::class, "created_by");
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

}
