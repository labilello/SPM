<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'codigo_unix';

    public function movements(){
        return $this->hasMany('App\Movement', 'product_id');
    }
}
