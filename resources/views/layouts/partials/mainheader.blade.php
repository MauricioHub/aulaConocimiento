<!-- Main Header -->
<header class="main-header">
    <!-- Logo -->       
    <a class="logo" style="background-color:white;">        
       <!-- mini logo for sidebar mini 50x50 pixels -->      
        <!-- <span class="logo-mini"><b>A</b>LT</span>      -->
        <!-- logo for regular state and mobile devices -->
        <img src="/aulaConocimiento/resources/image/logo.png" alt="Hogar de Cristo" height="60" width="200">        
        <!-- <span class="logo-lg"><b>Admin</b>LTE Laravel </span>      -->
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <!-- <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
        </a> -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Tasks Menu -->
                @if (Auth::guest())

                @else
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{asset('/img/user.png')}}" class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{asset('/img/user.png')}}" class="img-circle" alt="User Image" />
                            <p>
                                {{ Auth::user()->name }}
        
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Cerrar Sesión</a>
                            </div>
                        </li>
                    </ul>
                </li>
                @endif
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>
