<?php

namespace App\Presenters;

trait AdminPresenter 
{
    public function isSuperAdmin($roleType) 
    {
    	return ($roleType == getConfig('config', 'role_type.role_superadmin.value', 2)) ? true : false;
    }
}
