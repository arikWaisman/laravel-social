<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user(){
    	
    	return $this->belongsTo('App\User');
    
    }

    public function post(){
    	
    	return $this->belongsTo('App\Post');
    
    }

    public function likeText(){
    		
    	return 'Like from model';
    
    }

}	