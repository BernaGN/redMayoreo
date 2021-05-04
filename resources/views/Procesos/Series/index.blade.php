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
                        <h1 class="m-0">Series</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Sistema</a></li>
                            <li class="breadcrumb-item active">Series</li>
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
                                @if ($clientes->isNotEmpty() && $productos->isNotEmpty())
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-agregar">
                                        Agregar Serie
                                    </button>
                                @endif
                                @if (session('info'))
                                    <div class="alert alert-success"><strong>{{ session('info') }}</strong></div>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            @if ($serieEntregadas->count())
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center>Num. Pedido</center>
                                                </th>
                                                <th>
                                                    <center>Cliente</center>
                                                </th>
                                                <th>
                                                    <center>Clave</center>
                                                </th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                        </thead>
                                        <tbody>
                                            @foreach ($serieEntregadas as $serieEntregada)
                                                <tr>
                                                    <td>
                                                        <center><strong>{{ $serieEntregada->num_pedido }}</strong>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>{{ $serieEntregada->cliente->nombre }}</center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            {{ $serieEntregada->detalleSerieEntregadas[0]->producto->clave }}
                                                        </center>
                                                    </td>
                                                    <td width="10px">
                                                        <a class="btn btn-warning"
                                                            href="{{ route('series.edit', $serieEntregada->id) }}">
                                                            Editar
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('series.destroy', $serieEntregada->id) }}"
                                                            method="post">
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="return confirm('Quieres borrar el registro')">
                                                                Eliminar
                                                            </button>
                                                            @method('DELETE')
                                                            @csrf
                                                        </form>
                                                    </td>
                                                    <td><a class="btn btn-info"
                                                            href="{{ route('seriesPdf', $serieEntregada->num_pedido) }}">Generar
                                                            Reporte</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $serieEntregadas->links() }}
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
                    <h4 class="modal-title">Agregar Series</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('Procesos.Series.create')
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

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
@endsection
