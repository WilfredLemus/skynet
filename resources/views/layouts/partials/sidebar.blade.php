<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            {{-- <li class="header">NAVEGACIÓN</li> --}}
            @can('Menu Casos')
            <li class="header">CASOS</li>
            <li class="treeview @yield('modulo_casos')">
                <a href="#">
                    <i class="fa fa-slideshare"></i> <span>Modulo Casos</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @can('Crear Caso')
                    <li class="@yield('crear_caso')"><a href="{{ route('caso.create')}}"><i class="fa fa-plus"></i> Crear Caso</a></li>
                    @endcan
                    @can('Lista Casos')
                    <li class="@yield('lista_caso')"><a href="{{ route('caso.index') }}"><i class="fa fa-list"></i> Lista Casos</a></li>
                    @endcan
                    @can('Buscar Caso')
                    <li class="@yield('buscar_caso')"><a href="{{ route('caso.buscar')}}"><i class="fa fa-search"></i> Buscar Caso</a></li>
                    @endcan
                    @can('Menu Configuracion Casos')
                    <li class="treeview @yield('configuracion_casos')">
                        <a href="#">
                            <i class="fa fa-cogs"></i> Configuraciones
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('Menu Tipo Caso')
                            <li class="@yield('tipo_caso')"><a href="{{ route('tipocaso.index') }}"><i class="fa fa-circle-o"></i> Tipo Caso</a></li>
                            @endcan
                            @can('Menu Etapa Caso')
                            <li class="@yield('etapa_caso')"><a href="{{ route('etapacaso.index') }}"><i class="fa fa-circle-o"></i> Etapa Caso</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan

            @canany(['Menu Usuarios', 'Menu Organización', 'Menu Registros'])
            <li class="header">ADMINISTRACIÓN</li>
            @endcanany
            @can('Menu Usuarios')
            <li class="treeview @yield('modulo_usuarios')">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Modulo Usuarios</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @can('Menu Usuario')
                    <li class="@yield('usuarios')"><a href="{{ route('usuarios.index')}}"><i class="fa fa-user"></i> Usuarios</a></li>
                    @endcan
                    @can('Menu Rol')
                    <li class="@yield('roles')"><a href="{{ route('roles.index') }}"><i class="fa fa-user-circle-o"></i> Roles</a></li>
                    @endcan
                    @can('Menu Permiso')
                    <li class="@yield('permisos')"><a href="{{ route('permisos.index') }}"><i class="fa fa-lock"></i> Permisos</a></li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('Menu Organización')
            <li class="treeview @yield('organizacion')">
                <a href="#">
                    <i class="fa fa-building-o"></i> <span>Organización</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @can('Menu Puesto')
                    <li class="@yield('puestos')"><a href="{{ route('puestos.index') }}"><i class="fa fa-circle-o"></i> Puesto</a></li>
                    @endcan
                    @can('Menu Oficina')
                    <li class="@yield('oficina')"><a href="{{ route('oficina.index') }}"><i class="fa fa-circle-o"></i> Oficina</a></li>
                    @endcan
                    @can('Menu Empresa')
                    <li class="@yield('empresa')"><a href="{{ route('empresa.index') }}"><i class="fa fa-circle-o"></i> Empresa</a></li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('Menu Auditoria')
            <li class="treeview @yield('modulo_auditoria')">
                <a href="#">
                    <i class="fa fa-database"></i> <span>Auditoria</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="@yield('registros_todos')"><a href="{{ route('registros.all') }}"><i class="fa fa-circle-o"></i> Todos los Registros</a></li>
                </ul>
            </li>
            @endcan
        </ul>
    </section>
</aside>
