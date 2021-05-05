<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('images/redMayoreo/ICONsquare.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset(auth()->user()->foto) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li
                    class="nav-item {{ open('home') }} {{ open('/') }} {{ open('usuarios') }} {{ open('roles') }} {{ open('parametros') }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Sistema
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('parametros') }}" class="nav-link {{ active('parametros') }}">
                                <i class="{{ selectedIcon('parametros') }} fa-circle nav-icon"></i>
                                <p>Parametros</p>
                            </a>
                        </li>
                        @can('usuarios.index')
                            <li class="nav-item">
                                <a href="{{ route('usuarios.index') }}" class="nav-link {{ active('usuarios') }}">
                                    <i class="{{ selectedIcon('usuarios') }} fa-circle nav-icon"></i>
                                    <p>Usuarios</p>
                                </a>
                            </li>
                        @endcan
                        @can('roles.index')
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link {{ active('roles') }}">
                                    <i class="{{ selectedIcon('roles') }} fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                <li class="nav-item {{ open('proveedores') }} {{ open('clientes') }} {{ open('productos') }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Catalogos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('proveedores.index')
                            <li class="nav-item">
                                <a href="{{ route('proveedores.index') }}"
                                    class="nav-link {{ active('proveedores') }}">
                                    <i class="{{ selectedIcon('proveedores') }} fa-circle nav-icon"></i>
                                    <p>Proveedores</p>
                                </a>
                            </li>
                        @endcan
                        @can('clientes.index')
                            <li class="nav-item">
                                <a href="{{ route('clientes.index') }}" class="nav-link {{ active('clientes') }}">
                                    <i class="{{ selectedIcon('clientes') }} fa-circle nav-icon"></i>
                                    <p>Clientes</p>
                                </a>
                            </li>
                        @endcan
                        @can('productos.index')
                            <li class="nav-item">
                                <a href="{{ route('productos.index') }}" class="nav-link {{ active('productos') }}">
                                    <i class="{{ selectedIcon('productos') }} fa-circle nav-icon"></i>
                                    <p>Productos</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>

                <li class="nav-item {{ open('series') }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Procesos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('series.index')
                            <li class="nav-item">
                                <a href="{{ route('series.index') }}" class="nav-link {{ active('series') }}">
                                    <i class="{{ selectedIcon('series') }} fa-circle nav-icon"></i>
                                    <p>Series Entregadas</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Reportes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('series.index')
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-buscarSerie">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Series Entregadas</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<div class="modal fade" id="modal-buscarSerie">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Buscar Serie</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('Reportes.Series.form')
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
