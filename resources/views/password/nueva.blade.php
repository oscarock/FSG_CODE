<h2>Ingresa tu nueva contraseña</h2>

@if ($errors->any())
    <div style="color: red">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="{{ route('password.guardarNueva') }}" method="POST">
    @csrf
    <input type="password" name="password" placeholder="Nueva contraseña">
    <input type="password" name="password_confirmation" placeholder="Confirmar contraseña">
    <button type="submit">Guardar</button>
</form>