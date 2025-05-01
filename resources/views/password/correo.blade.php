<h2>Ingresa tu correo electronico</h2>

@if ($errors->any())
    <div style="color: red">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="{{ route('password.enviarCodigo') }}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Correo" required email>
    <button type="submit">Enviar código</button>
</form>