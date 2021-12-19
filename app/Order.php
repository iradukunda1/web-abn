<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(OrderedProduct::class);
    }
    public function agent()
    {
        return $this->belongsTo(User::class, "agent_id");
    }
}
