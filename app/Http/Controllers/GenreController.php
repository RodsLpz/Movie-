<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use Illuminate\Support\Facades\Log;

class GenreController extends Controller
{
    public function index(){
        return response()->json([
            'genres' => Genre::orderBy('id', 'DESC')->get()
        ],200);
    }

    public function getAllGenres(Request $request) 
    {
    	$genre = Genre::orderBy('id', 'DESC')->get();
    	return json_encode($genre);
    }

    public function saveGenre(Request $request)
    {
    	$genre = new Genre;
    	$genre->genre_name = $request->genre_name;
    	$genre->save();
    	return response()->json($genre);
    }

    public function editGenre(Request $request)
    {
    	$genre = Genre::where('id', $request->id)->first();
    	return response()->json($genre);
    }

    public function updateGenre(Request $request)
    {
    	$genre = Genre::where('id', $request->Gid)->first();
    	$genre->genre_name = $request->Gname;
    	$genre->save();

    	return response()->json($genre);
    }

    public function deleteGenre(Request $request)
    {
        $genre = Genre::where('id', $request->genre_id)->first();
        $genre->delete();

        return response()->json($genre);
    }

    public function search(Request $request)
    {
        $genre = Genre::where('id', 'LIKE', "%$request->search%")->orwhere('genre_name', 'LIKE', "%$request->search%")->get();

        return json_encode($genre);
    }
}
