<?php

namespace App\Http\Controllers\Seguridad;

use DateTime;
use DateInterval;
use Illuminate\Http\Request;
use App\Models\Seguridad\Usuario;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public $modelUsuario;
    public function __construct()
    {
        $this->modelUsuario = new Usuario();
    }

    public function login($url = null): View
    {
        return view('modulos.seguridad.auth.login', ['url' => $url, 'mensajes' => array()]);
    }


    public function acceso(Request $request)
    {
        if (!$request->isMethod('post') || !$request->ajax()) {
            return response()->json(['success' => false, 'message' => 'Método no permitido.'], 405);
        }
    
        $validator = Validator::make(
            $request->all(),
            [
                'usuarioAlias' => 'required',
                'usuarioPassword' => 'required'
            ],
            [
                'usuarioAlias.required' => 'El campo usuario es requerido.',
                'usuarioPassword.required' => 'El campo contraseña es requerido.'
            ]
        );
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray(),
                'required' => true
            ]);
        }
    
        $usuarioAlias = $request->usuarioAlias;
        $usuarioPassword = $request->usuarioPassword;
        $url = "/seguridad/usuario/catalogo";
    
        $usuario = $this->modelUsuario->obtenerUsuario($usuarioAlias);
        $validPassword = $usuario && Hash::check($usuarioPassword, $usuario->usuarioPassword);
    
        if (!$usuario || !$validPassword) {
            return response()->json([
                'success' => false,
                'required' => true,
                'message' => ['usuarioAlias' => ['Correo electrónico o contraseña incorrectos']]
            ]);
        }
    
        if (in_array($usuario->usuarioEstado, ['Bloqueado', 'Inactivo', 'Desactivado'])) {
            return response()->json([
                'success' => false,
                'required' => true,
                'message' => ['usuarioAlias' => ['Usuario no permitido: ' . $usuario->usuarioEstado]]
            ]);
        }
    
        $this->modelUsuario->guardarSesion($usuario->idUsuario);
        Auth::login($usuario);
    
        return response()->json([
            'success' => true,
            'message' => 'Excelente, logueo con éxito.',
            'url' => $url
        ]);
       
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}
