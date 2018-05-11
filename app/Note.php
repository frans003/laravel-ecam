<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public $primarykey = 'id';
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function course() {
        return $this->belongsTo('App\Course');
    }

    public function university() {
        return $this->belongsTo('App\University');
    }
}