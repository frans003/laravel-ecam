<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\University;

class CoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderby('course_id','asc')->paginate(10);
        return view('courses.index') -> with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $universities = University::all();
        return view('courses.create') -> with('universities', $universities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required',
            'university_id' => 'required',
            'name' => 'required'
        ]);

        $course = new Course;
        $course->course_id = $request -> input('course_id');
        $course->name = $request -> input('name');
        $course->user_id = auth()->user()->id;
        $course->university_id = $request -> input('university_id');
        $course->save();

        return redirect('/cours')->with('success', 'Cours créé');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        return view('courses.show')->with('course', $course);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);

        if(auth()->user()->id != $course->user_id){
            return redirect('/cours')->with('error', 'Utilisateur non authorisé');
        };

        return view('courses.edit')->with('course', $course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'course_id' => 'required',
        ]);

        //Update la note dans la base de données

        $course = Course::find($id);
        $course->course_id = $request -> input('course_id');
        $course->name = $request -> input('name');
        $course->save();

        return redirect('/cours')->with('success', 'Cours mis-à-jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        if(auth()->user()->id != $course->user_id){
            return redirect('/cours')->with('error', 'Utilisateur non authorisé');
        };

        $course -> delete();

        return redirect('/cours')->with('success', 'Cours supprimée');
    }
}
