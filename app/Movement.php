<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    public function status() {
        return $this->belongsTo('App\Status', 'status_id');
    }

    public function repair() {
        return $this->belongsTo('App\Repair', 'repair_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
