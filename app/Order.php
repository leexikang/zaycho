<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['ship'];
    /**
     * undocumented function
     *
     * @return void
     */
    public function products()
    {
        return $this->belongsToMany('App\Product', 'order_details');
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function delivery()
    {
        return $this->hasOne('App\Delivery');
    }
    
}
