<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BussinesCategory extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function merchants(){
        return $this->belongsToMany(BussinesCategory::class, Merchant::class,'bussiness_category_id','id');
    }
}
