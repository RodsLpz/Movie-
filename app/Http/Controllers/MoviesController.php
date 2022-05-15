<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Actor;
use App\Genre;
use App\Producer;
use DB;
use Image;
use App\Film_Actor;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MoviesController extends Controller
{
    public function index() 
    {
    	
        return response()->json(["movies"=>Movie::orderBy('id','DESC')->get()]);
    }
    public function getMovie(Request $request) 
    {
    	
        $movie = Movie::with('producers')->with('genres')->with('actors')->orderBy('id', 'DESC')->get();
    	return json_encode($movie);
    }

    public function viewFilm(Request $request)
    {
        
        $film = Movie::where('id', $request->id)->with('producers')->with('genres')->with('actors')->orderBy('id', 'DESC')->first();
        return json_encode($film);
    }


    public function addFilm() 
    {
        $actor = Actor::orderBy('id', 'DESC')->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $producer = Producer::orderBy('id', 'DESC')->get();

        $data = [];
        $data[0] = $actor;
        $data[1] = $genre;
        $data[2] = $producer;
        return json_encode($data);
    }

    public function saveFilm(Request $request)
    {
        $film = new Movie;
        $film->film_title = $request->film_title;
        $film->prod_id = $request->prod_id;
        $film->gen_id = $request->gen_id;
        $film->summary = $request->summary;
        $film->release_date = $request->release_date;
        $film->country = $request->country_release;
        $film->image = $request->image;
        

        
        $film->save();

        Log::info('Movie:', ['id'=> $film->id,'film_title'=> $film->film_title, 'prod_id'=> $film->producer, 'gen_id'=> $film->genre,'summary'=> $film->summary, 'release_date'=> $film->release_date,'country'=> $film->country,'image'=> $film->image]);
        Storage::put('public/img/movie_images/'.$request->image,base64_decode($request->imgMovie));
        
        return response()->json([
            "message" => "Movie Added"
        ], 201);
    }

    
    public function editFilm(Request $request) 
    {
        $actor = Actor::orderBy('id', 'DESC')->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $producer = Producer::orderBy('id', 'DESC')->get();
        $movie = Movie::where('id', $request->id)->with('producers')->with('genres')->with('actors')->first();

        $data = [];
        $data[0] = $actor;
        $data[1] = $genre;
        $data[2] = $producer;
        $data[3] = $movie;
        return json_encode($data);
    }

    
   public function updateFilm(Request $request) 
    {
        $film = Movie::where('id', $request->id)->first();
        $film->film_title = $request->film_title;
        $film->prod_id = $request->prod_id;
        $film->gen_id = $request->gen_id;
        $film->summary = $request->summary;
        $film->release_date = $request->release_date;
        $film->country = $request->country_release;
        $film->image = $request->image;
        $film->save();

        Log::info('Movie:', ['id'=> $film->id,'film_title'=> $film->film_title, 'prod_id'=> $film->producer, 'gen_id'=> $film->genre,'summary'=> $film->summary, 'release_date'=> $film->release_date,'country'=> $film->country,'image'=> $film->image]);
        Storage::put('public/img/movie_images/'.$request->image,base64_decode($request->imgMovie));
        
        return response()->json([
            "message" => "Movie Updated"
        ], 201);
    }   


        public function deleteFilm(Request $request)
    {
       
            $movie = Movie::where('id', $request->id)->first();
            $movie->delete();

            Log::warning('Movie Deleted',
             [
                'id'=>$movie->id
            ]);
    
            return response()->json([
                "message" => "Movie deleted!"
            ], 202);
    }

    public function search(Request $request)
    {
        $movie = Movie::where('film_title', 'LIKE', "%$request->search%")->get();

        return json_encode($movie);
    }

    public function Show_Actor($id){
        $showActorMovie = Film_Actor::with('actors')->where('movie_id', $id)->get();

        return response()->json([
            "showActorMovie" => $showActorMovie
        ], 202);

    }

    public function showActorFilm($id){
        $actorfilm = Film_Actor::with('movie')->where('actor_id', $id)->get();

        return response()->json([
            "actor_film" => $actorfilm
        ], 202);

    }
}

