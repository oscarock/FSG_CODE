<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Seguridad\Usuario;
use Illuminate\Support\Facades\Hash;

class PasswordRecoveryController extends Controller
{
    public function formCorreo() {
        return view('password.correo');
    }

    public function enviarCodigo(Request $request) {
        $request->validate(['email' => 'required|email']);
        $usuario = Usuario::where('usuarioEmail', $request->email)->first();

        if (!$usuario) {
            return back()->withErrors(['email' => 'El correo ingresado no se encuentra en la base de datos']);
        }

        $codigo = Str::upper(Str::random(6));
        $usuario->update([
            'codigoValidacion' => $codigo,
            'codigoExpira' => now()->addMinutes(15)
        ]);

        // Envía correo con código (se debe configurar en el .env los datos para el envio del mail por ahora queda en los logs)
        Mail::raw("Tu código de validación es: $codigo", function ($message) use ($usuario) {
            $message->to($usuario->usuarioEmail)
                ->subject('Código de recuperación de contraseña');
        });

        session(['email_recuperacion' => $usuario->usuarioEmail]);

        return redirect()->route('password.formCodigo');
    }

    public function formCodigo() {
        return view('password.codigo');
    }

    public function validarCodigo(Request $request) {
        $request->validate(['codigo' => 'required']);
        $usuario = Usuario::where('usuarioEmail', session('email_recuperacion'))->first();

        if (!$usuario || $usuario->codigoValidacion !== $request->codigo || now()->gt($usuario->codigoExpira)) {
            return back()->withErrors(['codigo' => 'El código ingresado es incorrecto o ha expirado']);
        }

        return redirect()->route('password.formNueva');
    }

    public function formNueva() {
        return view('password.nueva');
    }

    public function guardarNueva(Request $request) {
        $request->validate(['password' => 'required|min:8|confirmed']);
        $usuario = Usuario::where('usuarioEmail', session('email_recuperacion'))->first();
        $usuario->update([
            'usuarioPassword' => Hash::make($request->password),
            'codigoValidacion' => null,
            'codigoExpira' => null,
        ]);

        return redirect()->route('login')->with('success', 'Contraseña restablecida');
    }
}
