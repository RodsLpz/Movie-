<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function actor()
    {
    	return $this->belongsToMany(Actor::class, 'film_actor')->withPivot([
            'id',
            'actor_id',
            'movie_id'
        ]);
    }
    
	public function producer()
    {
    	return $this->belongsTo('App\Producer');
    }

    public function genre()
    {
    	return $this->belongsTo('App\Genre');
    }

    public function actor_film(){
        return $this->hasMany('App\Film_Actor', 'movie_id');
    }
}
