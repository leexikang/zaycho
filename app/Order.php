<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['ship', 'created_at', 'updated_at'];
    /**
     * undocumented function
     *
     * @return void
     */
    public function products()
    {
        return $this->belongsToMany('App\Product', 'order_details')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function total()
    {
        return $this->products->first()->price * $this->products->first()->pivot->quantity;
    }
    public function user()
    {
        return $this->belongsTo('App\User');
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

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

    public function scopeNew()
    {
        return $this->where(['valid' => true, 'archive' => false]);
    }
}
