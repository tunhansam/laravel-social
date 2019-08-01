
    <!-- Logo -->
    <a href="{{ route('dashboard') }}" class="logo">
        <span class="logo-mini"><b>PRL</b></span>
        <span class="logo-lg"><b>Laravel TEST</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="hidden">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav drop">
                <li class="dropdown user user-menu">
                    <a href="javascript:void(0)" class="dropdown-toggle">
                        <img src="{{ asset(getAvartaUrl()) }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ getCurrentName() }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ asset(getAvartaUrl()) }}" class="img-circle" alt="User Image">
                            <p>
                                {{ getCurrentName() }}
                                <small>{{ getCurrentEmail() }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('admin.edit', Auth::guard('admin')->user()->id) }}" class="btn btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout', Auth::guard('admin')->user()->id) }}" class="btn btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
