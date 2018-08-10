<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ asset(getAvartaUrl()) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{ getCurrentName() }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
        <li class="active treeview">
            <a href="{{ route('dashboard') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <?php
            if(checkCurrentAdmin()) { ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>Admin</span>
                    <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.index') }}"><i class="fa fa-list" aria-hidden="true"></i> All admin</a></li>
                    <li><a href="{{ route('admin.create') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new</a></li>
                    <li><a href="{{ route('admin.edit', Auth::guard('admin')->user()->id) }}"><i class="fa fa-folder" aria-hidden="true"></i> My Profile</a></li>
                </ul>
            </li>
        <?php } ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-users" aria-hidden="true"></i>
                <span>Users</span>
                <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('users.index') }}"><i class="fa fa-list" aria-hidden="true"></i> All users</a></li>
            </ul>
        </li>
    </ul>
</section>
<!-- /.sidebar -->