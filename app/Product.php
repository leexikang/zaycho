<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'minimun_sale', 'bought', 'due_date'];
    protected $dates = ['due_date'];

    /**
     *  Check if bough exceed sale
     *
     * @return Boolean
     */
    private function isSaleExceed()
    {
        if ($this->bought >= $this->signup ) {

            return true;
        }
        return false;
    }


    /**
     * set due_date attribute
     *
     *
     * @return void
    public function setDueDateAttribute($date)
    {
        $this->attributes['due_date'] = Carbon::parse($date);
    }

     */

    /**
     * set up asseter 
     *
     * @return Carbon 
     */
    public function getDueDateAttribute($date)
    {
        return new Carbon($date);
    }
    
    
    /**
     * check if user can bough the product
     *
     * @return boolean
     */
    
    public function canBuy()
    {
        return $this->isSaleExceed() && !$this->isDue();
    }

    /**
     * Caculate Total price for order
     *
     * @return void
     */

    public function state(){
    }
    /**
     * The orders the belong to the products 
     * 
     * @return 
     */

    public function orders()
    {
        return $this->belongsToMany('App\Order', 'order_details');
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }
    
    /**
     * Check whether the date is due
     *
     * @return boolean
     */
    public function isDue()
    {
        return $this->due_date->lt(Carbon::now());
    }


    public function scopeDue()
    {
        return $this->where('due_date', '<', Carbon::now());
    }
    
}
