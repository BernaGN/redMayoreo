<div class="form-group">
    <form action="{{ route('series.store') }}" method="POST">
        <label class="h5">Numero de Pedido</label>
        <input class="form-control" name="num_pedido" id="num_pedido" type="text" required>
        <label class="h5">Cliente</label>
        <select class="form-control" name="cliente_id">
            <option value=""></option>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
            @endforeach
        </select>
        <label class="h5">Clave</label>
        <select class="form-control" name="producto_id">
            <option value=""></option>
            @foreach ($productos as $producto)
                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
            @endforeach
        </select>
        <label class="h5">Series</label>
        <textarea name="series" cols="30" rows="10" class="form-control"></textarea>
        <button type="submit" class="btn btn-primary mt-2">Guardar</button>
        @csrf
    </form>
</div>
