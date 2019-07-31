<?php
namespace App\Rules;

class RulesAdmin
{
	public static function rules($request) {
		$rules = [
            'name'      => ['bail', 'required', 'max:50'],
            'email'     => ['bail', 'required', 'email', 'unique:admin,email,'.$request->id],
            'role_type' => ['required'],
            'avatar'    => ['bail', 'mimes:jpg,jpeg,png,gif', 'max:2048']
        ];

        if (!$request->id) {
            $rules['email']     = ['bail', 'required', 'email', 'unique:admin,email'];
            $rules['password']  = ['bail', 'required', 'min:6', 'confirmed'];
        }

        if (!empty($request->password)) {
            $rules['password']  = ['bail', 'required', 'min:6', 'confirmed'];
        }
        return $rules;
	}
}