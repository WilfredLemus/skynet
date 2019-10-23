<header class="main-header">
    <a href="/" class="logo">
        <span class="logo-mini">
            <img src="{{ asset('img/skynet.png') }}" height="27" alt="Logo Skynet">
        </span>
        <span class="logo-lg">
            <img src="{{ asset('img/skynet.png') }}" height="60" alt="Logo Skynet">
        </span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('img/user.png') }}" class="user-image" alt="Imagen de Usuario">
                        <span class="hidden-sm">{{ Auth::user()->nombre }}</span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ asset('img/user.png') }}" class="img-circle" alt="Imagen de Usuario">
                            <p>
                                {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}
                                <small>{{ Auth::user()->puesto->nombre }}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('miperfil') }}" class="btn btn-default btn-flat btn-block"><i class="fa fa-address-card-o"></i> Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-danger btn-flat btn-block" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> {{ __('Salir') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
  </header>
