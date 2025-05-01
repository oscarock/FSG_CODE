
<h2>Subir foto de perfil para {{ $usuario->usuarioAlias }}</h2>

@if ($errors->any())
    <div style="color: red">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="{{ route('usuarios.foto', $usuario->idUsuario) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Seleccionar imagen (.jpg, .jpeg, .png):</label><br>
    <input type="file" name="foto" required accept=".jpg,.jpeg,.png"><br><br>

    <button type="submit">Guardar</button>
    <a href="{{ route('usuarios.catalogo') }}">Cancelar</a>
</form>

@if ($usuario->usuarioFoto)
    <p>Imagen actual:</p>
    <img src="{{ asset('fotos_usuarios/' . $usuario->usuarioFoto) }}" width="100">
@endif
