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
        $courses = Course::all();
        $notes = Note::all();
        $universities = University::all();
        return view ('pages.index')->with('courses', $courses)->with('notes',$notes)->with('universities',$universities);
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
