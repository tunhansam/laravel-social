@extends('layouts.main')
@section('content')
    <section class="content-header">
        <h1>
            Admin
            <small>Edit admin</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li ><a href="{{ route('admin.index') }}">Admin</a></li>
            <li class="active">Edit admin</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col info-left">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Edit admin</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">
                        @include ('notification.success')
                        @include ('notification.error')
                        @if (empty($admin))
                            {{ trans('notification.notFound',['link'=>route('admin.index')]) }}
                        @else

                            {!! Form::model($admin, ['route' => ['admin.update',$admin->id], 'method' => 'PATCH', 'files' => true ]) !!}
                            
                            <input type="hidden" name="id" value="{{ $admin->id }}">
                            <div class="fileUpload">
                                <?php 
                                    $img_avatar = asset('images/placeholder.png');
                                    if(isset($admin->avatar)) $img_avatar = asset('uploads').'/'.$admin->avatar;
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
                                            $('#current_image').val('');
                                        }
                                        else {
                                            $("#thumbimage").attr('src', input.value);
                                            $("#thumbimage").show();
                                            $('#current_image').val('');
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
                            @if(isset($admin) && getCurrentAdmin()->id == $admin->id )
                                <div class="form-gr">
                                    {!! Form::label('password_old','Old password') !!}
                                    {!! Form::password('password_old',null) !!}
                                </div>
                            @endif
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
                                <button type="submit" class="btn btn-primary" name="add_admin" >Edit</button>
                            </div>
                            {!! Form::close() !!}
                        @endif
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
@endsection