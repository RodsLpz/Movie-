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


Route::post('login', 'PassportController@login');
Route::post('register', 'PassportController@register');
Route::post('logout', 'PassportController@logout');


// Route::middleware('auth:api')->group(function() {
   Route::middleware('auth:api')->group(function() {
    Route::get('user', 'PassportController@details');

    //Genre Routes
   Route::get('genres', 'GenreController@index')->name('user.genres');
   Route::post('genres', 'GenreController@getAllGenres')->name('user.getAllGenres');
   Route::post('genres/save', 'GenreController@saveGenre')->name('user.genre_save');
   Route::post('genres/edit', 'GenreController@editGenre')->name('user.genre_edit');
   Route::post('genres/update', 'GenreController@updateGenre')->name('user.genre_update');
   Route::post('genres/delete', 'GenreController@deleteGenre')->name('user.genre_delete');
   Route::post('genres/search', 'GenreController@search')->name('genre.search');


    // Movies

    Route::get('movies', 'MoviesController@index')->name('user.movies');
    Route::post('movies', 'MoviesController@getMovie')->name('user.getMovies');
    Route::post('movies/view', 'MoviesController@viewFilm')->name('user.view_film');
    Route::get('movies/add', 'MoviesController@addFilm')->name('user.add_film');
    Route::post('movies/save', 'MoviesController@saveFilm')->name('user.save_film');
    Route::post('movies/edit', 'MoviesController@editFilm')->name('user.edit_film');
    Route::put('movies/update', 'MoviesController@updateFilm')->name('user.update_film');
    Route::post('movies/delete', 'MoviesController@deleteFilm')->name('user.delete_film');
    Route::post('movies/search', 'MoviesController@search')->name('movies.search');


    Route::get('movies/showactor/{id}', 'MoviesController@Show_Actor')->name('user.Show_Actor');
    
    Route::get('movies/showmovie/{id}', 'MoviesController@showActorFilm')->name('user.showActorFilm');


    //Actors Routes
    Route::get('actors', 'ActorController@index')->name('user.actors');
    Route::post('actors', 'ActorController@getActor')->name('user.getActors');
    Route::post('actors/save', 'ActorController@saveActor')->name('user.actor_save');
    Route::post('actors/edit', 'ActorController@editActor')->name('user.actor_edit');
    Route::put('actors/update', 'ActorController@updateActor')->name('user.actor_update');
    Route::post('actors/delete', 'ActorController@deleteActor')->name('user.actor_delete');
    Route::post('actors/search', 'ActorController@searchActor')->name('actor.actor_search');

    Route::get('Specific_Actor/{id}', 'ActorController@getSpecificActor')->name('user.getSpecificActor');
    Route::post('Specific_Actor/saveactor', 'ActorController@savegetSpecificActor')->name('user.savegetSpecificActor');
    Route::put('Specific_Actor/save', 'ActorController@saveSpecificActor')->name('user.saveSpecificActor');

    // Producers Routes
    Route::get('producers', 'ProducerController@index')->name('user.producers');
    Route::post('producers', 'ProducerController@getAllProducers')->name('user.getAllProducers');
    Route::post('producers/save', 'ProducerController@saveProducer')->name('user.prod_save');
    Route::post('producers/edit', 'ProducerController@editProducer')->name('user.prod_edit');
    Route::put('producers/update', 'ProducerController@updateProducer')->name('user.prod_update');
    Route::post('producers/delete', 'ProducerController@deleteProducer')->name('user.prod_delete');
    Route::post('producers/search', 'ProducerController@search')->name('producer.search');

    //Role
    Route::get('roletypes', 'RolesController@index')->name('user.roletypes');
    Route::post('roletypes', 'RolesController@getAllRoles')->name('user.getAllRoles');
    Route::post('roletypes/save', 'RolesController@saveRole')->name('user.role_save');
    Route::post('roletypes/edit', 'RolesController@editRole')->name('user.role_edit');
    Route::post('roletypes/update', 'RolesController@updateRole')->name('user.role_update');
    Route::post('roletypes/delete', 'RolesController@deleteRole')->name('user.role_delete');
    Route::post('roletypes/search', 'RolesController@searchRoles')->name('role.search');



});