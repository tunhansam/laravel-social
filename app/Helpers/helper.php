<?php

/******* Get Config *****/
function getConfig ($file, $key, $default) {
	return (!empty(Config::get($file.'.'.$key))) ? Config::get($file.'.'.$key) : $default;
}

/******* Get current *****/
function getCurrentAdmin () {
	return (!empty(Auth::guard('admin')->user())) ? Auth::guard('admin')->user() :null;
}

/******* Get avarta Url *****/
function getAvartaUrl () {
    $img = getCurrentAdmin()->avatar;
    if (!empty($img) && file_exists(public_path().'/'.getConfig('config', 'upload_folder', 'uploads/').$img)) {
        return '/'.getConfig('config', 'upload_folder', 'uploads/').$img;
    }
    return getConfig('config', 'placeholder_image', '/images/placeholder.png');
}

/******* Get curent name *****/
function getCurrentName () {
    return getCurrentAdmin()->name;
}

/******* Get curent email *****/
function getCurrentEmail () {
    return getCurrentAdmin()->email;
}

/******* Check current admin *****/
function checkCurrentAdmin () {
    return (getCurrentAdmin()->role_type != getConfig('config','role_type.role_superadmin',['role_superadmin'=>['value' => 2, 'text' => 'Super admin']]) ) ? true : false;
}