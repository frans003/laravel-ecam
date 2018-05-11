<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\University;

class UniversitiesController extends Controller
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
        $universities = University::orderby('id','desc')->paginate(10);
        return view('universities.index') -> with('universities', $universities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('universities.create');
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
            'name' => 'required',
            'address' => 'required',
            'logo' => 'image|nullable|max:1900',
        ]);

        //Condition d'ajout d'image

        if($request->hasfile('logo')){
            $imagenamewithtext = $request->file('logo')->getClientOriginalName();
            $imagename = pathinfo($imagenamewithtext, PATHINFO_FILENAME);
            $imgextension = $request->file('logo')->getCLientOriginalExtension();
            $imagenametostore = $imagename.'_'.time().'.'.$imgextension;
            $path = $request ->file('logo')->storeAs('public\cover_images', $imagenametostore);
        } else {
            $imagenametostore = 'noimage.jpg';
        }

        $university = new University;
        $university->name = $request -> input('name');
        $university->address = $request -> input('address');
        $university->logo = $imagenametostore;
        $university->user_id = auth()->user()->id;
        $university->save();

        return redirect('/universites')->with('success', 'Université Inscrite');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $university = University::find($id);

        if(auth()->user()->id != $university->user_id){
            return redirect('/universites')->with('error', 'Utilisateur non authorisé');
        };

        return view('universities.edit')->with('university', $university);
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
            'address' => 'required',
        ]);

        //Update l'unif dans la base de données

        $university = University::find($id);
        $university->name = $request -> input('name');
        $university->address = $request -> input('address');
        $university->save();

        return redirect('/universites')->with('success', 'Université Mise-à-jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $university = University::find($id);

        if(auth()->user()->id != $university->user_id){
            return redirect('/universites')->with('error', 'Utilisateur non authorisé');
        };

        $university -> delete();

        return redirect('/universites')->with('success', 'Université supprimée');
    }
}
