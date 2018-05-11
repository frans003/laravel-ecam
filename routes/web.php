<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Authentification
Auth::routes();

//Retourne la page de bienvenue
Route::get('/', 'PagesController@index');

//Retourne le profil de la personne avec les informations
Route::get('/profile', 'PagesController@profile');

//Retourne le dashboard de la personne
Route::get('/dashboard', 'DashboardController@index');

//Controlleur pour les notes
Route::resource('notes', 'NotesController');

//Controlleur pour les cours
Route::resource('cours', 'CoursesController');

//Controlleur pour les universités
Route::resource('universites', 'UniversitiesController');