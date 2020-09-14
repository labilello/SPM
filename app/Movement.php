<?php

namespace App;

use Carbon\Carbon;
use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use EloquentJoin;
    protected $aggregateMethod = 'COUNT';

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
