<p>Hola, {{ $usuario->usuarioAlias }}</p>

@if (session('success'))
    <div style="color: green">{{ session('success') }}</div>
@endif

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Alias</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Foto</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->usuarioAlias }}</td>
                <td>{{ $usuario->usuarioNombre }}</td>
                <td>{{ $usuario->usuarioEmail }}</td>
                <td>
                    @if ($usuario->usuarioFoto)
                        <img src="{{ asset('fotos_usuarios/' . $usuario->usuarioFoto) }}" width="60">
                    @else
                        <span>No tiene foto</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('usuarios.formulario_foto', $usuario->idUsuario) }}">Adjuntar imagen</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>