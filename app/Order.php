<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('quantity');
    }

    public function getTotalQuantityAttribute()
    {
        $total_qty=0;
        foreach ($this->products as $key => $value) {
            $total_qty += $value->pivot->quantity;
        }
        return $total_qty;
    }
}
