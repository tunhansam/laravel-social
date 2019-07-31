<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $del_flag;
    protected $display;
    protected $status;
    protected $roleType;

    public function __construct() 
    {
    	$this->del_flag = getConfig('config', 'del_flag', ['no_delete' => 0, 'deleted' => 1]);
    	$this->display = getConfig('config', 'display', 10);
    	$this->status = getConfig('config', 'status', ['fb_active' => ['value' => 1, 'text' => 'Active'], 'fb_block' => ['value' => 2, 'text' => 'Blocked']]);
        $this->roleType = getConfig('config', 'role_type', ['superAdmin' => ['value' => 2, 'text' => 'Super admin'], 'role_admin' => ['value' => 1, 'text' => 'Admin']]);
    }
}
