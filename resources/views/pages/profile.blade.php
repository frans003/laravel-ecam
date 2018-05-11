@extends('layouts.app')

@section('PageName')
    Votre Profil
@endsection

@section('content')

    <h1 class="m-4">Vos informations</h1>

    <table class="table table-bordered ">
            <thead class="thead-light">
              <tr>
                <th scope="col" style="text-align:center">ID</th>
                <th scope="col" style="text-align:center">Identifiant</th>
                <th scope="col" style="text-align:center">E-Mail</th>
                <th scope="col" style="text-align:center">Inscrit le</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row" style="text-align:center">{{$user->id}}</th>
                <td style="text-align:center">{{$user->name}}</td>
                <td style="text-align:center">{{$user->email}}</td>
                <td style="text-align:center">{{$user->created_at}}</td>
              </tr>
            </tbody>
          </table>


@endsection