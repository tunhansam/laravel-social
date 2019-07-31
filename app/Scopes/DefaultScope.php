<?php 

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DefaultScope implements Scope 
{
	public function apply(Builder $builder, Model $model) 
	{	
		$builder->where('del_flag', getConfig('config','del_flag.no_delete',0));
	}
}