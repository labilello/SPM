<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Makepc extends Model
{
    protected $table = 'makepcs';

    protected $fillable = [
        'NV', 'parts', 'user_id'
    ];

    protected $casts = [
        'parts' => 'array'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function setNVAttribute($value) {
        $this->attributes['NV'] = sprintf("%09d", $value);
    }

    public function getIdAttribute() {
        return sprintf("%010d", $this->attributes['id']);
    }
}
