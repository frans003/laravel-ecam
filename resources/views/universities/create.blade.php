@extends('layouts.app')

@section('PageName')
    Créer Universités
@endsection

@section('content')

<div class="card card-body bg-light card border-dark p-4 m-4">

    <h1 class = "mt-2 mb-4">Inscrire une Université</h1>
   
    {!! Form::open(['action' => 'UniversitiesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
        <div class='form-group'>
                {{Form::label('name', 'Nom *')}}
                {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Nom'])}}
        </div>
    
        <div class='form-group'>
            {!! Form::Label('address', 'Adresse: *') !!}
            {{Form::text('address', '', ['class' => 'form-control', 'placeholder' => 'Adresse'])}}
        </div>

        <div class="form-group">
                <p>Logo de l'université: </p>
                {{form::file('logo')}}
        </div>

        <div class= "mt-4 mb-2">

            {{Form::submit('Ajouter', ['class' => 'btn btn-primary'])}}

            <a class="btn btn-secondary" href="./">Cancel</a>

        </div>

    {!! Form::close() !!}

</div>

@endsection