@extends('layouts.app')

@section('PageName')
    Afficher Note
@endsection

@section('content')

<a href="./" class ="btn btn-secondary mt-4"> < Retour</a>
     
<h3 class="m-4">{{$note->title}}</h3>

        <div class="row">
                <div class="col-md-2 col-sm-2">
                    <img style = "width:100%" src = "/Notes_App - V2/public/storage/cover_images/{{$note->course->university->logo}}">
                </div>
                <div class="col-md-10 col-sm-10">
                        <p> <span class="font-weight-bold"> Description: </span> {{$note->body}} </p>

                        @if ($note->course != null) 
                                <p> <span class="font-weight-bold"> Cours: </span> <span class="badge badge-pill badge-primary m-4">{{$note->course->course_id}}</span>{{$note->course->name}} </p>
                        @else 
                                <p><span class="badge badge-pill badge-warning m-2">Attention!</span> Cours n'existe plus!</p>
                        @endif
                        
                        <a href="/Notes_App - V2/public/storage/documents/{{$note->file_name}}" class="btn btn-success">Télécharger Document</a>
                </div>
        </div>

        <hr>

        <small>Last Updated: {{$note->updated_at}} <br/> Written by: {{$note->user->name}}</small>
    
        <hr>

        <div class="row">

        @if(!auth::guest()) <!-- les personnes qui ne sont pas connéctés ne verront pas les boutons edit et delete -->

                @if(auth::user()->id == $note->user_id) <!-- permet de donner la possibilité au createur du post de modoifer son post -->
                <div class="col-md-8">
                        <a href="/Notes_App/public/notes/{{$note->id}}/edit" class="btn btn-primary">Edit</a>
                </div>
                <div class="col-md-4 text-right">
                        {!!Form::open(['action' => ['NotesController@destroy', $note->id], 'method' => 'POST'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}
                </div>

                @endif
        @endif
        </div>

@endsection

