<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\Course;

class NotesController extends Controller
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
        $notes = Note::orderby('id','desc')->paginate(5);
        return view('notes.index') -> with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all('id', 'course_id', 'name');
        return view('notes.create')-> with('courses', $courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Les champs obligatoires

        $this->validate($request, [
            'course_id' => 'required',
            // 'university_id' => 'required',
            'title' => 'required',
            'body' => 'required',
            'document' => 'required|max:1900',
            // 'cover_image' => 'image|nullable|max:1900'
            // 'cover_image' => 'required'
        ]);

        // //Condition d'ajout d'image'
        // if($request->hasfile('cover_image')){
        //     $imagenamewithext = $request->file('cover_image')->getClientOriginalName();
        //     $imagename = pathinfo($filenamewithext, PATHINFO_FILENAME);
        //     $imgextension = $request->file('cover_image')->getCLientOriginalExtension();
        //     $imagenametostore = $filename.'_'.time().'.'.$imgextension;
        //     $path = $request ->file('cover_image')->storeAs('public\cover_images', $imagenametostore);
        // } else {
        //     $imagenametostore = 'noimage.jpg';
        // }

        $courses = Course::all();

        //Condition d'ajout de document
        if($request->hasfile('document')){
            $filenamewithext = $request->file('document')->getClientOriginalName();
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
            $extension = $request->file('document')->getCLientOriginalExtension();
            $filenametostore = $filename.'_'.time().'.'.$extension;
            $path = $request ->file('document')->storeAs('public\documents', $filenametostore);
        } else {
            $filenametostore = 'nodoc.doc';
        }

        //Ajouter une note

        $note = new Note;
        $note->course_id = $request -> input('course_id');
        $note->title = $request -> input('title');
        $note->body = $request -> input('body');
        $note->user_id = auth()->user()->id;
        $note->file_name = $filenametostore;
        // $note->cover_image = $request -> input('cover_image');
        $note->save();

        return redirect('/notes')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Note::find($id);
        return view('notes.show')->with('note', $note);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = Note::find($id);
        $courses = Course::all();

        if(auth()->user()->id != $note->user_id){
            return redirect('/notes')->with('error', 'Utilisateur non authorisé');
        };

        return view('notes.edit')->with('note', $note) -> with('courses', $courses);
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
            'title' => 'required',
            'body' => 'required',
        ]);

        //Update la note dans la base de données

        $note = Note::find($id);
        $note->title = $request -> input('title');
        $note->body = $request -> input('body');
        $note->course_id = $request -> input('course_id');
        $note->save();

        return redirect('/notes')->with('success', 'Post mis-à-jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);

        if(auth()->user()->id != $note->user_id){
            return redirect('/notes')->with('error', 'Utilisateur non authorisé');
        };

        $note -> delete();

        return redirect('/notes')->with('success', 'Note supprimée');
    }
}
