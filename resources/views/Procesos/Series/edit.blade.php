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
                            <div class="card-body">
                                @if (session('info'))
                                    <div class="alert alert-success"><strong>{{ session('info') }}</strong></div>
                                @endif
                                <div class="form-group">
                                    <form action="{{ route('series.update', $serieEntregada->id) }}" method="POST">
                                        <label class="h5">Numero de Pedido</label>
                                        <input class="form-control" name="num_pedido" id="num_pedido" type="text"
                                            value="{{ $serieEntregada->num_pedido }}" required>
                                        <label class="h5">Cliente</label>
                                        <select class="form-control" name="cliente_id" id="cliente_id">
                                            <option value=""></option>
                                            @foreach ($clientes as $cliente)
                                                <option value="{{ $cliente->id }}"
                                                    {{ $cliente->id == $serieEntregada->cliente_id ? 'selected' : '' }}>
                                                    {{ $cliente->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <label class="h5">Clave</label>
                                        <select class="form-control" name="producto_id">
                                            <option value=""></option>
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto->id }}"
                                                    {{ $producto->id == $serieEntregada->detalleSerieEntregadas[0]->producto_id ? 'selected' : '' }}>
                                                    {{ $producto->clave }}</option>
                                            @endforeach
                                        </select>
                                        <label class="h5">Series</label>
                                        <textarea name="nombre" cols="30" rows="10" class="form-control">
                                            @foreach ($series as $serie)
                                                {{ $serie->numSeries->nombre }}
                                            @endforeach
                                        </textarea>
                                        <button type="submit" class="btn btn-primary mt-2">Guardar</button>
                                        @csrf
                                        @method('PUT')
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
