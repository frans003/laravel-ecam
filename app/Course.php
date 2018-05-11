<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $primarykey = 'id';
    public $timestamps = true;
    
    public function notes() {
        return $this->hasMany('App\Note');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function university() {
        return $this->belongsTo('App\University');
    }
}
