<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;

class Category extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            $slug = Str::slug($category->name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $category->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
