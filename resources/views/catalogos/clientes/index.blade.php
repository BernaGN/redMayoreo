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
                        <h1 class="m-0">Clientes</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Catalogos</a></li>
                            <li class="breadcrumb-item active">Clientes</li>
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

                                @can('clientes.store')
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-agregar">
                                        Agregar cliente
                                    </button>
                                @endcan
                                <div class="card-tools">
                                    <form action="{{ route('clientes.index') }}" method="get">
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
                            @if ($clientes->count())
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
                                                    <center>Fecha de creacion</center>
                                                </th>
                                                @can('clientes.update')
                                                    <th></th>
                                                @endcan
                                                @can('clientes.destroy')
                                                    <th></th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($clientes as $cliente)
                                                <tr>
                                                    <td>
                                                        <center><strong>{{ $cliente->id }}</strong></center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $cliente->nombre }}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $cliente->direccion }}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $cliente->email }}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $cliente->fijo }}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $cliente->celular }}</center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $cliente->created_at->diffForHumans() }}</center>
                                                    </td>
                                                    @can('clientes.update')
                                                        <td>
                                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                                data-target="#modal-editar"
                                                                data-id_cliente="{{ $cliente->id }}"
                                                                data-nombre="{{ $cliente->nombre }}"
                                                                data-direccion="{{ $cliente->direccion }}"
                                                                data-email="{{ $cliente->email }}"
                                                                data-fijo="{{ $cliente->fijo }}"
                                                                data-celular="{{ $cliente->celular }}"">
                                                                                                                                                    Editar
                                                                                                                                                </button>
                                                                                                                                        </td>
                                                                                        @endcan
                                                                                        @can('clientes.update')
                                                                                                                    <td>
                                                                                                                        <form action="
                                                                {{ route('clientes.destroy', $cliente->id) }}" method="post">
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
                                    {{ $clientes->links() }}
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
                    <h4 class="modal-title">Agregar cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('catalogos\clientes\create')
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
    <div class="modal fade" id="modal-editar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($clientes->isNotEmpty())
                        @include('catalogos\clientes\edit')
                    @endif
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

@section('modal')
    <script>
        $('#modal-editar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Botón que activó el modal
            var id_cliente = button.data('id_cliente')
            var nombre = button.data('nombre') // Extraer la información de atributos de datos
            var direccion = button.data('direccion')
            var email = button.data('email')
            var fijo = button.data('fijo')
            var celular = button.data('celular')

            var modal = $(this)
            modal.find('.modal-body #id').val(id_cliente)
            modal.find('.modal-body #nombre').val(nombre)
            modal.find('.modal-body #direccion').val(direccion)
            modal.find('.modal-body #email').val(email)
            modal.find('.modal-body #fijo').val(fijo)
            modal.find('.modal-body #celular').val(celular)
        })

    </script>
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

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard3.js') }}"></script>
@endsection
