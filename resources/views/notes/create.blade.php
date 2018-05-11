@extends('layouts.app')

@section('PageName')
    Créer Note
@endsection

@section('content')
    <h1 class = "mt-4">Ajouter une note</h1>
    <span class="badge badge-pill badge-primary">Creation</span>
    <br>
    <br>

    {!! Form::open(['action' => 'NotesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
        <div class="form-row">
                <div class='form-group col-md-8'>
                        {{Form::label('title', 'Titre *')}}
                        {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Titre'])}}
                </div>
                <div class="form-group col-md-4">
                {!! Form::Label('course', 'Cours: *') !!}
                <select class="custom-select" name="course_id">
                        <option value="">Sélectionner...</option>
                        @foreach($courses as $course)
                        <option value="{{$course->id}}">{{$course->course_id}}: {{$course->name}} </option>
                        @endforeach
                </select>
                </div>
        </div>
    
        <div class='form-group'>
            {{Form::label('body', 'Description *')}}
            {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Indiquez ici les détails sur le document (type, date, auteurs, ...)', 'rows' => "4"])}}
        </div>

        <div class="form-group">
                <p>Votre document: *</p>
                {{form::file('document')}}
        </div>


        {{-- <div class="form-group">
                <p>Votre image:</p>
                {{form::file('cover_image')}}
        </div> --}}

        {{Form::submit('Create', ['class' => 'btn btn-primary'])}}

        <a class="btn btn-secondary" href="./">Cancel</a>

    {!! Form::close() !!}

@endsection