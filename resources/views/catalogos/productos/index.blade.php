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
                        <h1 class="m-0">Productos</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Catalogos</a></li>
                            <li class="breadcrumb-item active">Productos</li>
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
                                @can('productos.store')
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-agregar">
                                        Agregar Producto
                                    </button>
                                @endcan
                                <a class="btn btn-light" href="{{ route('exportar-productos') }}">
                                    Exportar
                                </a>
                                <div class="links">
                                    <form method="post" action="{{ url('importar-productos') }}"
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
                                    <form action="{{ route('productos.index') }}" method="get">
                                        <div class="input-group input-group-sm" style="width: 350px;">
                                            <input type="text" name="search" class="form-control float-right"
                                                placeholder="Ingrese el nombre del producto" value="{{ $texto }}">

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
                            @if ($productos->count())
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
                                                    <center>Clave</center>
                                                </th>
                                                <th>
                                                    <center>Proveedor</center>
                                                </th>
                                                @can('productos.update')
                                                    <th></th>
                                                @endcan
                                                @can('productos.destroy')
                                                    <th></th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($productos as $producto)
                                                <tr>
                                                    <td>
                                                        <center><strong>{{ $producto->id }}</strong></center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $producto->nombre }}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $producto->clave }}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $producto->proveedor->nombre }}</center>
                                                    </td>
                                                    @can('productos.update')
                                                        <td>
                                                            <a class="btn btn-warning"
                                                                href="{{ route('productos.edit', $producto->id) }}">
                                                                Editar
                                                            </a>
                                                        </td>
                                                    @endcan
                                                    @can('productos.destroy')
                                                        <td>
                                                            <form action="{{ route('productos.destroy', $producto->id) }}"
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
                                    {{ $productos->links() }}
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
                    <h4 class="modal-title">Agregar producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('catalogos\productos\create')
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
