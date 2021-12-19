<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedProduct extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class,"customer_id");
    }
    public function merchant()
    {
        return $this->belongsTo(Merchant::class,"merchant_id");
    }

    public function order()
    {
        return $this->belongsTo(Order::class,"agent_id");
    }
}
