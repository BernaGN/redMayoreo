<div class="form-group">
    <form action="{{ route('productos.update', 'test') }}" method="POST">
        <input type="hidden" id="id" name="id" value="">
        <label class="h5">Nombre</label>
        <input class="form-control" name="nombre" id="nombre" type="text" required>
        <label class="h5">Clave</label>
        <input class="form-control" name="clave" id="clave" type="text" required>
        <label class="h5">Proveedor</label>
        <select name="proveedor_id" class="form-control" id="proveedor_id">
            <option value=""></option>
            @foreach ($proveedores as $proveedor)
                <option value="{{ $proveedor->id }}">
                    {{ $proveedor->nombre }}
                </option>
            @endforeach
        </select>
        <br>
        <button type="submit" class="btn btn-primary mt-2">Guardar</button>
        @csrf
        @method('PUT')
    </form>
</div>
