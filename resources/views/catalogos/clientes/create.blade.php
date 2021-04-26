<div class="form-group">
    <form action="{{ route('clientes.store') }}" method="POST">
        <label class="h5">Nombre</label>
        <input class="form-control" name="nombre" id="nombre" type="text" required>
        <label class="h5">Direccion</label>
        <input class="form-control" name="direccion" id="direccion" type="text" required>
        <label class="h5">Email</label>
        <input class="form-control" name="email" id="email" type="email" required>
        <label class="h5">Fijo</label>
        <input class="form-control" name="fijo" id="fijo" type="text" required>
        <label class="h5">Celular</label>
        <input class="form-control" name="celular" id="celular" type="text" required>

        <button type="submit" class="btn btn-primary mt-2">Guardar</button>
        @csrf
    </form>
</div>
