<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;


class PagesControllerApi extends Controller
{
    public function index() {
        // Va nous aider a formater les informations qui sont renvoyés, en utulisant la resource
        return view ('index');
    }

}
