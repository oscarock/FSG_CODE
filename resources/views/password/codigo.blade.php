<h2>Ingresa el codigo de verificacion</h2>

@if ($errors->any())
    <div style="color: red">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="{{ route('password.validarCodigo') }}" method="POST">
    @csrf
    <input type="text" name="codigo" placeholder="Código de validación">
    <button type="submit">Validar</button>
</form>