<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Ducktype;

class stockIn extends Model
{

  protected  $fillable = ['product_name', 'price', 'slug', 'quantity', 'category_id'];
  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id', 'id');
  }
  public function consumed_stockOut(){
    return $this->hasMany(consumed_stockOut::class);
  }
}
