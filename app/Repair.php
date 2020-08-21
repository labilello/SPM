<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{

    protected $dates = [
        'date_in',
        'date_out'
    ];

    public function product () {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function status () {
        return $this->belongsTo('App\Status', 'status_id');
    }

    public function movements() {
        return $this->hasMany('App\Movement');
    }

}
