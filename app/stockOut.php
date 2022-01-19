<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stockOut extends Model
{
    protected $fillable = ['stockIn_id', 'quantity'];

    public function stockIn()
    {
        return $this->belongsTo(stockIn::class, 'stockin_id', 'id');
    }
}
