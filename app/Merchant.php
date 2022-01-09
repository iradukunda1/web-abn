<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function registered_by()
    {
        return $this->belongsTo(User::class, "registered_by");
    }
    public function category()
    {
        return $this->belongsTo(BussinesCategory::class,"bussiness_category_id");
    }
    public function user(){
        return $this->belongsTo(User::class,'registered_by','id');
    }
}
