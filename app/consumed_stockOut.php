<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class consumed_stockOut extends Model
{

    protected $fillable = ['stockIn_id', 'stockOut_id', 'quantity_stockIn', 'quantity_stockOut'];
    public function stockIn()
    {
        return $this->belongsTo(stockIn::class, 'stockIn_id', 'id');
    }
    public function stockOut()
    {
        return $this->belongsTo(stockOut::class, 'stockOut_id', 'id');
    }
}
