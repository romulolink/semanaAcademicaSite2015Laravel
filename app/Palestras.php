<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Palestras extends Model
{
    protected $table = 'palestras';


     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    

    //public $timestamps = false;
   

     public function likes()
	{
	    return $this->belongsToMany('App\User', 'likes');
	}

}
