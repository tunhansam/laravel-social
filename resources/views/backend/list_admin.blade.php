@extends('layouts.main')
@section('content')
    <section class="content-header">
        <h1>
            Admin
            <small>List admin</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li ><a href="{{ route('admin.index') }}">Admin</a></li>
            <li class="active">List admin</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col full-content">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List admin</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include ('notification.success')
                        @include ('notification.error')
                        <div id="list-admin">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="left">
                                        <?php 
                                        $display = getConfig('config','display',15);
                                        if (isset($_GET['display'])) $display = $_GET['display'];
                                        ?>
                                        <input type="number" value="{{ $display }}" onchange="limitChanged(this)">
                                    </div>
                                    <div id="example1_filter" class="dataTables_filter">
                                        {!! Form::open(['route'=>'admin.index','method'=>'GET']) !!}
                                        <label>Search:{!! Form::text('search',Request::get('search'),['type'=>'search','class'=>'form-control input-sm']) !!}</label>
                                        @if (Request::get('limit'))
                                            <input type="hidden" name="limit" value="{{ Request::get('limit') }}">
                                        @endif
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Updater</th>
                                            <th>Task</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $roleSuperAdmin = getConfig('config', 'role_type.role_superadmin', ['value' => 2, 'text' => 'Super admin']);
                                                $roleAdmin = getConfig('config', 'role_type.role_admin', ['value' => 1, 'text' => 'Admin']);
                                            ?>
                                            @foreach ( $admin as $row )
                                            <tr>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->email }}</td>
                                                <td style="text-align: center;">
                                                   {{ ($row->role_type == $roleSuperAdmin['value']) ? $roleSuperAdmin['text'] : $roleAdmin['text'] }}
                                                </td>
                                                <td style="text-align: center;">
                                                    {{ (!empty($row->updater->name)) ? $row->updater->name : "" }}
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="{{ route('admin.edit',$row->id) }}" class="btn btn-app btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                    @if ($row->role_type != $roleSuperAdmin['value'])
                                                        {!! Form::open(['route'=>['admin.destroy', $row->id],'method'=>'DELETE']) !!}
                                                        <button type="submit" onclick="return confirm('{{ trans('notification.sure',['name'=>$row->name]) }}')" class="btn btn-app btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        {!! Form::close() !!}
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                        Show {{ count($admin) }} / {{ $total }}
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        
                                       {{ $admin->appends(Request::except('page'))->render() }}
                                       
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
@endsection