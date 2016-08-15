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
        return $this->belongToMany('App\Product', 'order_details');
    }
    
}
