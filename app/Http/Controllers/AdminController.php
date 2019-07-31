<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use Validator;
use Session;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\AdminRepository;
use App\Uploader\Image;
use App\Rules\RulesAdmin;

class AdminController extends Controller {
    protected $_admin;
    private function getRequest(Request $request) {
        $data = $request->all();
        $data['del_flag'] = $this->del_flag['no_delete'];
        if ($request->hasFile('avatar')) {
            $img = $request->file('avatar');
            Image::saveImageToTempFolder($img);
            Session::put('avatar', Image::getInfoImageBeforeUpload($img));
        }
        return $data;
    }

    public function __construct(AdminRepository $admin) {
        parent::__construct();
        $this->_admin = $admin;
    }
    public function dashboard() {
        return view('backend.dashboard');
    }
    public function isSuperAdmin() {
        return $this->_admin->isSuperAdmin(getCurrentAdmin()->role_type);
    } 
    public function index(Request $request) {
        if ($this->isSuperAdmin()) {

            // Pagination
        	$display = ($request->get('display')) ? $request->get('display') : $this->display[0];
            $page = ($request->get('page')) ? trim($request->get('page')) : 1;

            // Search
            $search = ($request->get('search')) ? $request->get('search') : '';
            $total = count($this->_admin->all());
            $admin = $this->_admin->with('updater')->getList($search, $display);
        	
        	return view('backend.list_admin', compact('admin', 'total', 'display', 'page'));
        }

        // Role admin
        return redirect()->route('role');
    }
    public function role() {
        return view('notification.404');
    }
    public function create() {
        if ($this->isSuperAdmin()) {
            return view('backend.create');
        }
        // Role admin
        return redirect()->route('role');
    }
    public function store(Request $request){
        if(!getCurrentAdmin()->isSuperAdmin(getCurrentAdmin()->role_type)) {
            return redirect()->route('role');
        }
        $data = $this->getRequest($request);
        $validator = Validator::make($request->all(), RulesAdmin::rules($request));
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data['ins_id'] = Auth::guard('admin')->user()->id;
        $data['upd_id'] = Auth::guard('admin')->user()->id;
        if (Session::has('avatar')) {
            $avatar = Session::get('avatar');
            if ($imgName = Image::uploadImage($avatar)) {
                $data['avatar'] = $imgName;
                Session::forget('avatar');
            } else {
                $errors['upload'] = trans('notification.updateFail');
                return redirect()->back()->withErrors($errors)->withInput();
            }
        }
        $admin = $this->_admin->create($data);
        Session::flash('success', trans('notification.createSuccess'));
        return redirect()->back();
    }
    public function edit($id) {
        if ($this->isSuperAdmin() || getCurrentAdmin()->id == $id) {
            $admin = $this->_admin->find($id);
            return view('backend.edit_admin', compact('admin'));
        }
        // Role admin
        return redirect()->route('role');
    }
    public function update($id, Request $request) {
        if(!$this->isSuperAdmin() && getCurrentAdmin()->id != $id) {
            return redirect()->route('role');
        }
        $admin = $this->_admin->find($id);
        if(empty($admin)) {
            $errors['update'] = trans('notification.updateFail');
            return redirect()->route('admin.index')->withErrors($errors);
        }
        $data = $this->getRequest($request);
        $validator = Validator::make($request->all(), RulesAdmin::rules($request));
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //Check old password
        if(!empty($data['password_old']) && !Hash::check($data['password_old'], $admin->password)) {
            $errors['update'] = trans('notification.passOldNoValid');
            return redirect()->back()->withErrors($errors)->withInput();
        }
        if(empty($data['password'])) unset($data['password']);
        $data['upd_id'] = getCurrentAdmin()->id;
        $oldAvatar = null;
        if (Session::has('avatar')) {
            $avatar = Session::get('avatar');
            // Get old image
            if (!empty($admin->avatar) && file_exists(public_path().'/'.getConfig('config', 'upload_folder', 'uploads/').$admin->avatar)) {
                $oldAvatar = $admin->avatar;
            }
            // Upload image
            if ($imgName = Image::uploadImage($avatar)) {
                $data['avatar'] = $imgName;
                Session::forget('avatar');
                Image::formatTempFolder();
            } else {
                $errors['upload'] = trans('notification.uploadAvatarFail');
                return redirect()->back()->withErrors($errors)->withInput();
            }
        }

        if ($admin->update($data)) {
            Image::deleteImage($oldAvatar);
            if (!empty($data['password'])) {
                Auth::guard('admin')->logout();
                return redirect()->route('login');
            }
            Session::flash('success', trans('notification.success', ['type' => 'Update', 'name' => $admin->name]));
            return redirect()->back();
        }
        $errors['update'] = trans('notification.updateFail');
        return redirect()->back()->withErrors($errors)->withInput();
    }
    function destroy($id) {
        if (!getCurrentAdmin()->isSuperAdmin(getCurrentAdmin()->role_type)) {
            return redirect()->route('role');
        }         
        $admin = $this->_admin->find($id);
        if (empty($admin)) {
            $errors['delete'] = trans('notification.deleteFail', ['name' => $admin->name]);
            return redirect()->route('admin.index')->withErrors($errors);
        } 
        if (!empty($admin->avatar) && file_exists(public_path().'/'.getConfig('config', 'upload_folder', 'uploads/').$admin->avatar)) {
            $oldAvatar = $admin->avatar;
        }
        $data = [
            'del_flag' => 1, 
            'upd_id' => getCurrentAdmin()->id
        ];
        if ($admin->update($data)) {
            // Delete old avatar
            Image::deleteImage($oldAvatar);
            $data['avatar'] = '';
            $admin->update($data);
            Session::flash('success', trans('notification.deleteSuccess', ['name' => $admin->name]));
            return redirect()->route('admin.index');
        }
        $errors['delete'] = trans('nofitication.deleteFail', ['name' => $admin->name]);
        return redirect()->back()->withErrors($errors)->withInput();       
    }
}
