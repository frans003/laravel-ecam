@extends('layouts.app')

@section('PageName')
    Ajouter Cours
@endsection

@section('content')
    <h1 class = "mt-4">Ajouter un cours</h1>
    <span class="badge badge-pill badge-primary">Creation</span>
    <br>
    <br>

    {!! Form::open(['action' => 'CoursesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
        <div class='form-group'>
            {{Form::label('course_id', 'ID du cours *')}}
            {{Form::text('course_id', '', ['class' => 'form-control', 'placeholder' => 'ID'])}}
        </div>
    
        <div class='form-group'>
            {{Form::label('name', 'Nom du cours *')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Nom du cours'])}}
        </div>

        <div class="form-group">
            {!! Form::Label('university_id', 'Université: *') !!}
            <select class="custom-select" name="university_id">
                    <option value="">Sélectionner...</option>
                    @foreach($universities as $university)
                        <option value="{{$university->id}}">{{$university->name}} </option>
                    @endforeach
            </select>
        </div>

        {{Form::submit('Create', ['class' => 'btn btn-primary'])}}

        <a class="btn btn-secondary" href="./">Cancel</a>

    {!! Form::close() !!}

@endsection