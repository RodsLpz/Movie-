<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    public function movie()
    {
    	return $this->belongsToMany(Movie::class, 'film_actor')->withPivot([
            'id',
            'actor_id',
            'movie_id'
        ]);
    }

    public function actorm(){
        return $this->hasMany('App\Film_Actor', 'actor_id');
    }
}
