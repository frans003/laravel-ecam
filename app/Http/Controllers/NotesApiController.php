<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Note;
use App\Http\Resources\Note as NoteResource;

class NotesApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::orderBy('updated_at', 'desc')->paginate(5);
        return NoteResource::collection($notes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $note = new Note;
        $note->user_id = $request -> input('user_id');
        $note->course_id = $request -> input('course_id');
        $note->title = $request -> input('title');
        $note->body = $request -> input('body');
        $note->file_name = $request -> input('file_name');
        $note->save();
        return new NoteResource($note);
        return response() -> json('success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Note::findOrFail($id);
        return new NoteResource($note);
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
        $note = Note::find($id);
        $note->user_id = $request -> input('user_id');
        $note->course_id = $request -> input('course_id');
        $note->title = $request -> input('title');
        $note->body = $request -> input('body');
        $note->file_name = $request -> input('file_name');
        $note->save();
        return new NoteResource($note);
        return response() -> json('success', 200);
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
        $note -> delete();
        return response() -> json('success', 200);
    }
}
