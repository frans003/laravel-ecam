@extends('layouts.app')

@section('PageName')
    Index Université
@endsection

@section('content')

    <div class="my-3 p-3 bg-white rounded box-shadow">
        
        <!-- Titre -->

        <h6 class="border-bottom border-gray pb-2 mb-0">Universités Inscrites</h6>
            @if(count($universities)>0)

                @foreach($universities as $university)

                    <div class="media text-muted pt-3">
                        {{-- style="width: 50px; height: 40px;" --}}
                        <img src= "/Notes_App - V2/public/storage/cover_images/{{$university->logo}}" alt="Logo {{$university->name}}" width="5%" class="mr-2 media-object rounded"> 

                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <strong class="d-block text-gray-dark">{{$university->name}}</strong>
                            {{$university->address}}
                        </p> <a href="/Notes_App - V2/public/universites/{{$university->id}}/edit" class="btn btn-primary btn-sm">Modifier</a>
                    </div>
                @endforeach
            
            @else <!-- S'il n'y a pas de données dans la base de données -->
                <div class="media text-muted pt-3">
                    <img alt="" class="mr-2 rounded">

                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <strong class="d-block text-gray-dark">Pas d'universités inscrites! :(</strong>
                    </p>



                </div>

            @endif

    </div>

    <small class="d-block text-right mt-3">
        {{$universities->links()}} 
    </small>


@endsection