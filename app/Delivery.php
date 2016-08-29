<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    //
    protected $fillable = ['ship', 'arrive', 'arrival_date'];

    /**
     * undocumented function
     *
     * @return void
     */
    public function order()
    {
        $this->hasOne('App\Order');
    }
    
}
