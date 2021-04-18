<form action="{{ route('roles.store') }}" method="POST">
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre del rol" required>
    </div>
    <h2 class="h3">Lista de Permisos</h2>
    @foreach ($permisos as $permiso)
        <label>
            {!! Form::checkbox('permissions[]', $permiso->id, null, ['class' => 'mr-1']) !!} {{ $permiso->description }}
        </label><br>
    @endforeach
    <button type="submit" class="btn btn-primary">Crear Rol</button>
    @csrf
</form>
