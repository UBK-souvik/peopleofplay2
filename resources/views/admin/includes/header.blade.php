{{! $user = Auth::guard('admin')->user() }}
  <header class="main-header">
    <!-- Logo -->
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><!-- <img height="30" src="{{ imageBasePath('logo/logo.png') }}" /> --><b>{{ adminTransLang('company') }}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ adminTransLang('toggle_navigation') }}</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if($user->profile_image)
                            <img src="{{ imageBasePath($user->profile_image) }}" class="user-image">
                        @else
                            <img src="{{ imageBasePath('backend/images/logo/logo.png') }}" class="user-image">
                        @endif
                        <span class="hidden-xs">{{ ucfirst($user->name) }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            @if($user->profile_image)
                            <img src="{{ imageBasePath($user->profile_image) }}" class="img-circle">
                            @else
                            <img src="{{ imageBasePath('backend/images/logo/logo.png')}}" class="img-circle">
                            @endif
                            <p>
                                {{ ucfirst($user->name) }}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('admin.admins.update', ['id' => $user->id]) }}" class="btn btn-default btn-flat">{{ adminTransLang('profile') }}</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">{{ adminTransLang('sign_out') }}</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
