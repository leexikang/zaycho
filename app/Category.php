<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public $timestamps = false;
    protected $fillable = ['name'];
    /**
     * undocumented function
     *
     * @return void
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    
}
