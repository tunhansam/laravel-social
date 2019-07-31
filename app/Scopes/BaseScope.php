<?php 

namespace App\Scopes;

trait BaseScope 
{	
	public function scopeSearchEmail($query, $value){
		return $query->where('email','LIKE', '%'.$value.'%');
	}
}