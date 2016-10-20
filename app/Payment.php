<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
    protected $fillable = ['pay', 'user_id', 'order_id'];

    public function order(){
        return $this->belongsTo('App\Order');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function scopeNew(){
        return $this->where('pay', false);
    }
}
