<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{

    protected $fillable = ['first_name', 'last_name','prod_age'];

    public function movie()
    {
    	return $this->belongsTo('App\Movie');
    }
}
