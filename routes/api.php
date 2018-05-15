<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Index Page Vue
Route::get('/', 'PagesControllerApi@index');

//Afficher la liste de toutes les notes
Route::get('notes', 'NotesApiController@index');

//Renvoie tous les cours
Route::get('cours', 'CoursesController@api');

//Montre une note selon son id
Route::get('notes/{id}', 'NotesApiController@show'); 

//Enregistre la note
Route::post('notes', 'NotesApiController@store'); 

//Mise-à-jour d'une note
Route::put('notes/{id}', 'NotesApiController@update'); 

//Effacer une note
Route::delete('notes/{id}', 'NotesApiController@destroy');
