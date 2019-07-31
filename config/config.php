<?php
return [
	// Facebook
	'app_id'		=>	'200816700731379',
	'app_pass'		=>	'93d9f778f03bedde7b03a471698a6f04',
	'app_version'	=>	'v2.2',
	'fb_blocked'	=> 	'Tài khoản đã bị khóa',

	//Mailer
	'smtp_mailer'	=> 	'smtp',
	'smtp_auth'		=> 	true,
	'smtp_host'		=>	'smtp.gmail.com',
	'smtp_port'		=>	587,
	'smtp_secure'	=> 'tls',
	'smtp_username'	=> 'tunguyenngoc24@gmail.com',
	'smtp_pass'		=> 'dlybpzttnrkbysbk',
	'smtp_from'		=> 'tunguyenngoc24@gmail.com',
	'smtp_name'		=> 'Notifition Paraline',
	'smtp_subject'		=> 'Thành viên mới đăng ký',

	

	// config upload
    'upload_folder' => '/uploads/',
    'upload_temp_folder' => '/uploads/tmp/',
    'placeholder_image' => '/images/placeholder.png',
	'max_size'		=> 2000000,
	'type_image'	=> ['image/png','image/gif','image/jpg','image/jpeg'],

	// Pagination
	'start'			=> 0,
	'display'		=> 10,
	'page'			=> 1,	

	// staus
	'del_flag'		=> ['no_delete'=> 0, 'deleted'=>1],
	'role_type'		=> ['role_superadmin'=> ['value' => 2, 'text' => 'Super admin'],'role_admin'=> ['value' => 1, 'text' => 'Admin']],
	'status'		=> ['fb_active'=>['value' => 1, 'text' => 'Active'],'fb_block'=>['value' => 2, 'text' => 'Block']]
];