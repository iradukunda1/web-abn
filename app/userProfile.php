<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userProfile extends Model
{
    protected $table="user_profile";

    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
