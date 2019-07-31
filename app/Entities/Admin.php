<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Admin.
 *
 * @package namespace App\Entities;
 */
class Admin extends BaseModel implements Transformable, UserInterface, RemindableInterface
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    public function getRememberTokenName(){
	 	return null; // not supported
	}
	 
	/**
	* Overrides the method to ignore the remember token.
	*/
	public function setAttribute($key, $value)
	{
		$isRememberTokenAttribute = $key == $this->getRememberTokenName();
		if (!$isRememberTokenAttribute){
		  	parent::setAttribute($key, $value);
		}
	}
}
