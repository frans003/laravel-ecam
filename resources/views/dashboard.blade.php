@extends('layouts.app')

@section('PageName')
    Dashboard
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <a href="/Notes_App - V2/public/profile" class="btn btn-secondary m-2" >Mon Profil </a>
                        <a href="/Notes_App - V2/public/notes/create" class="btn btn-primary m-2">Ajouter une note</a> <br><br>

                        <h3>Vos notes ajoutées</h3>

                        <br>

                        @if(count($notes)>0)
                            <table class="table table-striped">
                                <tr>
                                    <th>Titre</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            
                            @foreach($notes as $note)
                                <tr>
                                    <th>{{$note->title}}</th>
                                    <th><a href="/Notes_App - V2/public/notes/{{$note->id}}/edit" class="btn btn-primary">Modifier</a></th>
                                    <th><a href="/Notes_App - V2/public/notes/{{$note->id}}" class="btn btn-success">Afficher</a></th>
                                </tr>
                            @endforeach
                            </table>

                        @else

                            <p>Pas de notes trouvées!</p>

                        @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection