<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use App\Repositories\AdminRepository;
use Mail;

class UsersController extends Controller
{
    protected $_user;
    protected $_admin;

    public function __construct(UserRepository $user, AdminRepository $admin)
    {
        $this->_user = $user;
        $this->_admin = $admin;
        parent::__construct();
    }

    public function index(Request $request)
    {
        // Sort
        $row = ($request->get('row')) ? trim($request->get('row')) : 'id';
        $arrange = ($request->get('arrange')) ? trim($request->get('arrange')) : 'desc';

        // Pagination
        $limit = ($request->get('limit')) ? $request->get('limit') : getConfig('config', 'limit.0', 10);
        $page = ($request->get('page')) ? trim($request->get('page')) : 1;

        // Search
        $name = ($request->get('name')) ? $request->get('name') : '';
        $email = ($request->get('email')) ? $request->get('email') : '';

        $total = count($this->_user->all());

        // Get data
        $users = $this->_user->getList($name, $email, $row, $arrange, $limit);

        return view('users.index', compact('users', 'total', 'page', 'limit'));
    }




}
