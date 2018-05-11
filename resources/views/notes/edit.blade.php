@extends('layouts.app')

@section('PageName')
    Modifier Note
@endsection

@section('content')
    <h1 class = "mt-4">Modifier votre note</h1>
    <span class="badge badge-pill badge-warning">Modification</span>
    <br>
    <br>

    {!! Form::open(['action' => ['NotesController@update', $note->id] , 'method' => 'POST' ]) !!}
        <div class='form-group'>
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $note->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>

        <div class='form-group'>
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $note->body, ['class' => 'form-control', 'placeholder' => 'Body text'])}}
        </div>

        <div class="form-group">
            {!! Form::Label('course', 'Cours:') !!}
                <select class="form-control mb-4" name="course_id">
                    @if ($note->course === null)
                        <option value="1">Selectionner...</option> 
                    @else
                        <option value="{{$note->course->id}}">{{$note->course->course_id}}: {{$note->course->name}} </option>
                    @endif

                    @foreach($courses as $course)
                        <option value="{{$course->id}}">{{$course->course_id}}: {{$course->name}} </option>
                    @endforeach
        </div>

        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Confirm', ['class' => 'btn btn-primary'])}}
        <a class="btn btn-secondary" href="./">Cancel</a>
    {!! Form::close() !!}

@endsection