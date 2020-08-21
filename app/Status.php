<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';


    public function movements(){
        return $this->hasMany('App\Movement', 'status_id');
    }

    public function repairs(){
        return $this->hasMany('App\Repair', 'repair_id');
    }
}
