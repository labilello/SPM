<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{

    protected $dates = ['date_in', 'date_out'];

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
