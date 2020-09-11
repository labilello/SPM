<?php

namespace App;

use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use EloquentJoin;
    protected $aggregateMethod = 'COUNT';

    protected $dates = [
        'date_in',
        'date_out'
    ];

    protected $casts = [
        'is_repair' => 'boolean'
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

    public function shipment() {
        return $this->belongsTo('App\Shipment');
    }

}
