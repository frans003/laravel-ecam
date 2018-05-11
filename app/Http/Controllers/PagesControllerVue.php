<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Note;
use App\Course;
use App\University;

class PagesController extends Controller
{
    public function index() {
        // return view ('vue.index');
    }

    public function about() {
        return view('pages.about');
    }

    public function profile() {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('pages.profile')->with('user', $user);
    }
}
