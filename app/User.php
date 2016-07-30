<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Model; 

class User extends Authenticatable 
{

	public function posts(){
		
		return $this->hasMany('App\Post');
	
	}	

}