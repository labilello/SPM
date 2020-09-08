<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $casts = [
        'is_closed' => 'boolean'
    ];

    protected $fillable = ['name', 'shipto'];

    public function repairs() {
        return $this->hasMany('App\Repair');
    }

    public function scopeClosed($query, $value)
    {
        return $query->where('is_closed', $value);
    }

}
