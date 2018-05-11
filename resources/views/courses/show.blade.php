@extends('layouts.app')

@section('PageName')
    Afficher Cours
@endsection

@section('content')

<a href="./" class ="btn btn-secondary mb-4 mt-2"> < Go Back</a>

<div class="container">

    <h2><span class="badge badge-pill badge-primary">{{$course->course_id}}</span> : {{$course->name}}</h2>

</div>

        <hr>

        <small>Last Updated: {{$course->updated_at}} <br/> Added by: {{$course->user->name}} <br> DB ID: {{$course->id}}</small>
    
        <hr>

        @if(!auth::guest()) <!-- les personnes qui ne sont pas connéctés ne verront pas les boutons edit et delete -->

                @if(auth::user()->id == $course->user_id) <!-- permet de donner la possibilité au createur du post de modoifer son post -->
                        <a href="/Notes_App - V2/public/cours/{{$course->id}}/edit" class="btn btn-primary">Edit</a>
                        
                        {!!Form::open(['action' => ['CoursesController@destroy', $course->id], 'method' => 'POST'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}

                @endif
        @endif

@endsection

