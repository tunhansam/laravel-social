@extends('layouts.main')
@section('content')
    <section class="content-header">
        <h1>
            Admin
            <small>Add admin</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li ><a href="{{ route('admin.index') }}">Admin</a></li>
            <li class="active">Add admin</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col info-left">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Add admin</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">
                        @include ('notification.success')
                        @include ('notification.error')
                        {!! Form::open(['route' => 'admin.store', 'files' => true ]) !!}
                        <div class="fileUpload">
                            <?php 
                                $img_avatar = asset('images/placeholder.png');
                                if(session('avatar') !== null) $img_avatar = asset('uploads/tmp/').'/'.session('avatar')['name'];
                            ?>
                            <span><img src="<?php echo $img_avatar; ?>" alt="Ảnh mô tả" id="thumbimage" ></span>
                            {!! Form::file('avatar',['class'=>'form-control upload','id'=>'upload-file','onchange'=>'readURL(this);']) !!}
                            <script>
                                function readURL(input) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function (e) {
                                            $("#thumbimage").attr('src', e.target.result);
                                            $("#input").attr('src', e.target.result);
                                        }
                                        reader.readAsDataURL(input.files[0]);
                                        $("#thumbimage").show();
                                    }
                                    else {
                                        $("#thumbimage").attr('src', input.value);
                                        $("#thumbimage").show();
                                    }
                                }
                            </script>
                        </div>
                        <div class="form-gr">
                            {!! Form::label('email','Email') !!}
                            {!! Form::text('email', null) !!}
                        </div>
                        <div class="form-gr">
                            {!! Form::label('name','Full Name') !!}
                            {!! Form::text('name', null) !!}
                        </div>
                        <div class="form-gr">
                            {!! Form::label('password','Password') !!}
                            {!! Form::password('password',null) !!}
                        </div>
                        <div class="form-gr">
                            {!! Form::label('password_confirmation','Re password') !!}
                            {!! Form::password('password_confirmation',null) !!}
                        </div>
                        <div class="form-gr">
                            {!! Form::label('role_type','Level') !!}
                            <?php
                            $roleType = getConfig('config', 'role_type', ['role_superadmin' => ['value' => 2, 'text' => 'Super admin'], 'role_admin' => ['value' => 1, 'text' => 'Admin']]);
                            $listRole = [];
                            foreach ($roleType as $role => $value) {
                                $listRole[$value['value']] = $value['text'];
                            }

                            $disabled = (isset($admin) && getCurrentAdmin()->role_type == $admin->role_type && getCurrentAdmin()->id == $admin->id) ? true : false;
                            ?>
                            {!! Form::select('role_type', $listRole, null, ['placeholder' => '--- Select level ---', 'disabled' => $disabled]) !!}
                            @if ($disabled)
                                {!! Form::hidden('role_type', $admin->role_type) !!}
                            @endif
                        </div>

                        <div class="form-gr">
                            <button type="submit" class="btn btn-primary" name="add_admin" >Add new</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
@endsection