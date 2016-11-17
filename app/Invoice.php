<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['id', 'order_id'];
    public function order(){
        return $this->belongsTo('App\Order');
    }
}
