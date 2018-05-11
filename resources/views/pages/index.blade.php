@extends('layouts.app')

@section('PageName')
    Acceuil
@endsection

@section('content')

    <div class="container">

        <br>

            <div class="jumbotron">
                    <h1 class="display-5">Bienvenue sur la plateforme de partage de notes!</h1>
                    <p class="lead">Cette application a pour but centraliser les notes dans un grand catalogue accessible aux étudiants!</p>
                    <hr class="my-4">
                    <h5>Universités inscrites: {{count($universities)}}</h5>
                    <h5>--> Cours: {{count($courses)}}</h5>
                    <h5>----> Notes: {{count($notes)}}</h5>
                    <br>
                    <a class="btn btn-primary" href="/Notes_App - V2/public/notes" role="button">Commencer</a>
            </div>

    </div>

@endsection