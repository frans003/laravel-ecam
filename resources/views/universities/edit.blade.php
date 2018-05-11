@extends('layouts.app')

@section('PageName')
    Modifier Université
@endsection

@section('content')
<div class="card card-body bg-light card border-dark p-4 m-4">
    
    <h1 class = "mt-2">Modifier l'Université: <strong class="text-gray-dark"> {{$university->name}} </strong> </h1>

    {!! Form::open(['action' => ['UniversitiesController@update', $university->id] , 'method' => 'POST' ]) !!}
        <div class='form-group'>
            {{Form::label('name', 'Nom: ')}}
            {{Form::text('name', $university->name, ['class' => 'form-control', 'placeholder' => ''])}}
        </div>

        <div class='form-group'>
            {{Form::label('address', 'Adresse: ')}}
            {{Form::text('address', $university->address, ['class' => 'form-control', 'placeholder' => ''])}}
        </div>

        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Confirm', ['class' => 'btn btn-primary'])}}

        <a class="btn btn-secondary" href="/Notes_App - V2/public/universites">Cancel</a>

    {!! Form::close() !!}

    {!! Form::open(['action' => ['UniversitiesController@destroy', $university->id] , 'method' => 'POST' ]) !!}
    
        <div class= "mt-2 mb-2">
            @if(auth::user()->id == $university->user_id) <!-- permet de donner la possibilité au createur du post de modoifer son post -->
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            @endif
        </div>

    {!! Form::close() !!}
</div>

@endsection