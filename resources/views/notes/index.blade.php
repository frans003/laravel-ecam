@extends('layouts.app')

@section('PageName')
    Index Notes
@endsection

@section('content')

        <h3 class="m-4">Les dernières notes ajoutées</h3>

    <div class="float-right">
        <a href="/Notes_App - V2/public/notes/create" class="btn btn-primary m-4" >Ajouter +</a>
    </div>

    <span class="badge badge-pill badge-secondary m-4">Liste: plus récent d'abord</span>

    @if(count($notes)>0)

        @foreach($notes as $note)

            <div class="card card-body bg-light card border-dark p-4 m-4">
                
                    <div class="row">
                        <div class="col-md-2 col-sm-2 ">
                            <img style = "width:100%" src = "/Notes_App - V2/public/storage/cover_images/{{$note->course->university->logo}}" alt="Logo {{$note->course->university->name}}">
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <h3 class="card-title">
                                <a href="notes/{{$note->id}}">
                                    {{$note->title}}
                                </a> 
                            </h3>

                            <p class="card-text mb-0"> {{$note->body}} </p>

                            <small>Post ID: {{$note->id}}</small>
                        </div>
                    </div>
                
            </div>

        @endforeach

        {{-- Montre les numéros de page avec la fonction paginate --}}
        {{$notes->links()}} 

    @else
        <br/>
        <br/>
        <p class="m-4">Pas de notes disponibles :(</p>

    @endif

@endsection