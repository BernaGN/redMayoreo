<div class="form-group">
    {!! Form::model($usuario, ['route' => ['usuarios.update', $usuario->id], 'method' => 'put']) !!}
    <label class="h5">Nombre</label>
    <input class="form-control" name="name" id="name" readonly>
    <h2 class="h5">Lista de roles</h2>
    @foreach ($roles as $rol)
        <div>
            <label>{!! Form::checkbox('roles[]', $rol->id, false, ['class' => 'mr-1']) !!} {{ $rol->name }}</label>
        </div>
    @endforeach
    <button type="submit" class="btn btn-primary mt-2">Guardar</button>
    {!! Form::close() !!}
</div>
