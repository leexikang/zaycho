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
        return $this->belongsTo('App\Order');
    }

    public function ScopeShipped(){
        return $this->where([
            ['ship', '=', true],
            ['arrive', '=', false],
        ]);
    }

     public function ScopeUnship(){
        return $this->where('ship', false);
     }

    public function ScopeArrived(){
        return $this->where('arrive', true);
    }
}
