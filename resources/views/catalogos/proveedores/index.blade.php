@extends('layouts.plantilla')

@section('css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endsection

@section('contenido')
    <div class="content-wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Proveedores</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Catalogos</a></li>
                            <li class="breadcrumb-item active">Proovedores</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                @can('proveedores.store')
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-agregar">
                                        Agregar Proveedor
                                    </button>
                                @endcan
                                <a class="btn btn-light" href="{{ route('exportar-proveedores') }}">
                                    Exportar
                                </a>
                                <div class="links">
                                    <form method="post" action="{{ url('importar-proveedores') }}"
                                        enctype="multipart/form-data">
                                        <fieldset>
                                            <legend>Importar datos</legend>
                                            @csrf
                                            <input type="file" name="excel">
                                            <br><br>
                                            <input type="submit" value="Enviar" style="padding: 10px 20px;">
                                        </fieldset>
                                    </form>
                                </div>
                                <div class="card-tools">
                                    <form action="{{ route('proveedores.index') }}" method="get">
                                        <div class="input-group input-group-sm" style="width: 350px;">
                                            <input type="text" name="search" class="form-control float-right"
                                                placeholder="Ingrese el nombre o el representante"
                                                value="{{ $texto }}">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @if (session('info'))
                                    <div class="alert alert-success"><strong>{{ session('info') }}</strong></div>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            @if ($proveedores->count())
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center>ID</center>
                                                </th>
                                                <th>
                                                    <center>Nombre</center>
                                                </th>
                                                <th>
                                                    <center>Direccion</center>
                                                </th>
                                                <th>
                                                    <center>Email</center>
                                                </th>
                                                <th>
                                                    <center>Fijo</center>
                                                </th>
                                                <th>
                                                    <center>Celular</center>
                                                </th>
                                                <th>
                                                    <center>Representante</center>
                                                </th>
                                                <th>
                                                    <center>Fecha de creacion</center>
                                                </th>
                                                @can('proveedores.update')
                                                    <th></th>
                                                @endcan
                                                @can('proveedores.destroy')
                                                    <th></th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($proveedores as $proveedor)
                                                <tr>
                                                    <td>
                                                        <center><strong>{{ $proveedor->id }}</strong></center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $proveedor->nombre }}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $proveedor->direccion }}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $proveedor->email }}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $proveedor->fijo }}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $proveedor->celular }}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $proveedor->representante }}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $proveedor->created_at->diffForHumans() }}</center>
                                                    </td>
                                                    @can('proveedores.update')
                                                        <td>
                                                            <a class="btn btn-warning"
                                                                href="{{ route('proveedores.edit', $proveedor->id) }}">
                                                                Editar
                                                            </a>
                                                        </td>
                                                    @endcan
                                                    @can('proveedores.destroy')
                                                        <td>
                                                            <form action="{{ route('proveedores.destroy', $proveedor->id) }}"
                                                                method="post">
                                                                <button type="submit" class="btn btn-danger"
                                                                    onclick="return confirm('Quieres borrar el registro')">
                                                                    Eliminar
                                                                </button>
                                                                @method('DELETE')
                                                                @csrf
                                                            </form>
                                                        </td>
                                                    @endcan
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $proveedores->links() }}
                                </div>
                                <!-- /.card-body -->
                            @else
                                <div class="card-body"><strong>No hay registros</strong></div>
                            @endif
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->

            </div>

        </div>
    </div>
    <div class="modal fade" id="modal-agregar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Proveedor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('catalogos\proveedores\create')
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('js')
    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
@endsection
