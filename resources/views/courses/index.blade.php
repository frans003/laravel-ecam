@extends('layouts.app')

@section('PageName')
    Index Cours
@endsection

@section('content')

    <h3 class="mt-4">Les cours</h3>
    <span class="badge badge-pill badge-warning mt-4">Attention: Pour modifier un cours il faut être l'auteur de celui-ci</span>

    <div class="card-body">

            <a href="/Notes_App - V2/public/notes" class="btn btn-secondary m-2" >Les Notes</a>
            <a href="/Notes_App - V2/public/cours/create" class="btn btn-primary m-2">Ajouter un cours</a> <br><br>
            
            <br>

            @if(count($courses)>0)

                <table class="table table-bordered" style="text-align:center">
                    
                    <tr class="table-primary">
                        <th>Nom</th>
                        <th>ID</th>
                        <th>Université</th>
                        <th>Modifier</th>
                        <th>Plus d'infos</th>
                    </tr>
                
                @foreach($courses as $course)
                    <tr>
                        <th>{{$course->name}}</th>
                        <th>{{$course->course_id}}</th>
                        <th>{{$course->university->name}}</th>

                        @if(!auth::guest()) <!-- les personnes qui ne sont pas connéctés ne verront pas les boutons edit et delete -->
                            @if(auth::user()->id == $course->user_id) <!-- permet de donner la possibilité au createur du post de modoifer son post -->
                                <th><a href="/Notes_App - V2/public/cours/{{$course->id}}/edit" class="btn btn-primary">Modifier</a></th>
                            @else
                                <th>
                                    <button type="button" class="btn btn-danger" disabled>X</button>
                                </th>
                             @endif
                        @else
                            <th>
                                    <button type="button" class="btn btn-danger" disabled>X</button>
                            </th>
                        @endif
                                <th><a href="/Notes_App - V2/public/cours/{{$course->id}}" class="btn btn-success">Voir</a></th>
                        
                    </tr>
                
                    @endforeach

                </table>

            @else

                <p>Pas de cours disponibles!</p>

            @endif
</div>
        {{-- Montre les numéros de page avec la fonction paginate --}}
        {{$courses->links()}} 

@endsection

