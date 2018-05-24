@extends('layouts.app')

@section('PageName')
    Modifier Cours
@endsection

@section('content')

    <h1 class = "mt-4">Modifier le cours</h1>
    <span class="badge badge-pill badge-warning">Modification</span>
    <br>
    <br>

    {!! Form::open(['action' => ['CoursesController@update', $course->id] , 'method' => 'POST' ]) !!}
        <div class='form-group'>
            {{Form::label('course_id', 'ID du cours')}}
            {{Form::text('course_id', $course->course_id, ['class' => 'form-control', 'placeholder' => ''])}}
        </div>

        <div class='form-group'>
            {{Form::label('name', 'Nom')}}
            {{Form::text('name', $course->name, ['class' => 'form-control', 'placeholder' => ''])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Confirm', ['class' => 'btn btn-primary'])}}
        <a class="btn btn-secondary" href="./">Annuler</a>
    {!! Form::close() !!}

@endsection