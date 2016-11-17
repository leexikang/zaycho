<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staffs';

    public function scopeLogin($query){
        return $this->where('email', $query);
    }
}
