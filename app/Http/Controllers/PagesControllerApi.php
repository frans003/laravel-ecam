<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Note;
use App\Course;
use App\University;

class PagesControllerApi extends Controller
{
    public function index() {
        return view ('vue.index');
    }

}
