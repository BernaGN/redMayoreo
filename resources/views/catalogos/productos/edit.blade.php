<div class="form-group">
    <form action="{{ route('productos.store') }}" method="POST">
        <label class="h5">Nombre</label>
        <input class="form-control" name="nombre" id="nombre" type="text" required>
        <label class="h5">Clave</label>
        <input class="form-control" name="clave" id="clave" type="text" required>
        <label class="h5">Proveedor</label>
        <select name="proveedor_id">
            <option value=""></option>
            @foreach ($proveedores as $proveedor)
                <option value="{{ $proveedor->id }}"
                    {{ $proveedor->nombre == $producto->proveedor->nombre ? 'selected' : '' }}>
                    {{ $proveedor->nombre }}
                </option>
            @endforeach
        </select>
        <br>
        <button type="submit" class="btn btn-primary mt-2">Guardar</button>
        @csrf
    </form>
</div>
