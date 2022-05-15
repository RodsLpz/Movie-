<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film_Actor extends Model
{
     protected $table = 'film_actor';

    public function movie()
    {
    	return $this->belongsTo('App\Movie', 'movie_id');
    }

    public function actors(){
        return $this->belongsTo('App\Actor', 'actor_id');
    }


   

    // public function actors()
    // {
    // 	return $this->hasMany('App\Actor', 'actor_id', 'id');
    // }

    // public function movie()
    // {
    // 	return $this->hasMany('App\Movie', 'movie_id', 'id');
    // }

}
