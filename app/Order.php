<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Order extends Model
{
    protected $fillable = ['ship', 'created_at', 'updated_at', 'user_id'];
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

    /**
     * undocumented function
     *
     * @return void
     */
    

    public function total()
    {
        return $this->products->first()->price * $this->products->first()->pivot->quantity;
    }

    public function checkout(){
        return $this->checkout;
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

    public function invoice()
    {
        return $this->hasOne('App\Invoice');
    }

    public function scopeNew()
    {
        return $this->where(['valid' => true, 'archive' => false]);
    }


    /**
     * undocumented function
     *
     * @return void
     */
/*    public function archive()*/
    //{
        //return $this->payment->pay && $this->delivery->arrive;
    //}
    
}
