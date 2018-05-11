<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    public $primarykey = 'id';
    public $timestamps = true;
    
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function notes() {
        return $this->hasMany('App\Note');
    }

    public function courses() {
        return $this->hasMany('App\Course');
    }
}
