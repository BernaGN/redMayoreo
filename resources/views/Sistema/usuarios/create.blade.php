<div class="form-group">
    <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
        <label class="h5">Nombre</label>
        <input class="form-control" name="name" type="text" required>
        <label class="h5">Email</label>
        <input class="form-control" name="email" type="text" required>
        <label class="h5">Contraseña</label>
        <input class="form-control" name="password" type="password" required>
        <label class="h5 mt-5">Foto</label>
        <input type="file" name="foto">
        <h2 class="h5">Lista de roles</h2>
        @foreach ($roles as $rol)
            <div>
                <label>{!! Form::checkbox('roles[]', $rol->id, null, ['class' => 'mr-1']) !!} {{ $rol->name }}</label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary mt-2">Guardar</button>
        @csrf
    </form>
</div>
