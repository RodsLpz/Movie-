<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producer;
use Illuminate\Support\Facades\Log;

class ProducerController extends Controller
{
    public function index()
    {
        return response()->json([
            'producer_array' => Producer::orderBy('id', 'DESC')->get()
    ],200);
    }

    public function getAllProducers(Request $request) 
    {
    	$prod = Producer::orderBy('id', 'DESC')->get();
    	return json_encode($prod);
    }
    public function saveProducer(Request $request)
    {
    	$producer = new Producer;
        $producer->first_name = $request->first_name;
        $producer->last_name = $request->last_name;
    	$producer->prod_age = $request->prod_age;
    	$producer->save();

        Log::info('Producer:', ['id'=> $producer->id,'first_name'=> $producer->first_name,'last_name'=> $producer->last_name,'age'=> $producer->prod_age]);
        return response()->json([
            "message" => "producer Added"
        ], 201);
    }
    public function editProducer(Request $request)
    {
    	$prod = Producer::where('id', $request->id)->first();
    	return response()->json($prod,200);
    }

    public function updateProducer(Request $request)
    {
    	$prod = Producer::where('id', $request->id)->first();
    	$prod->first_name = $request->first_name;
        $prod->last_name = $request->last_name;
        $prod->prod_age = $request->prod_age;
    	$prod->save();

    	// return response()->json($prod);

        Log::notice('Producer Updated', ['id'=>$prod->id,'first_name'=>$prod->first_name,'last_name'=>$prod->last_name,'age'=>$prod->prod_age]);
        return response()->json([
            "message" => "Producer updated!"
        ], 201);
    }

    public function deleteProducer(Request $request)
    {
        $prod = Producer::where('id', $request->id)->first();
        $prod->delete();

        // return response()->json($prod);

        Log::warning('Producer Deleted', [
            'id'=>$prod->id
        ]);

        return response()->json([
            "message" => "Producer deleted!"
        ], 202);
    }


    public function search(Request $request)
    {
        $producer = Producer::where('id', 'LIKE', "%$request->search%")->orwhere('first_name', 'LIKE', "%$request->search%")->orwhere('last_name', 'LIKE', "%$request->search%")->orwhere('prod_age', 'LIKE', "%$request->search%")->get();
        return json_encode($producer);
    }
}