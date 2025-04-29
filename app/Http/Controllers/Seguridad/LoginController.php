<?php

namespace App\Http\Controllers\Seguridad;

use DateTime;
use DateInterval;
use Illuminate\Http\Request;
use App\Models\Seguridad\Usuario;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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

        if ($request->isMethod('post')) {
            if ($request->ajax()) {

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
                    $message  = $validator->errors()->toArray();
                    return response()->json(['success' => false, 'message' => $message, 'required' => true]);
                }

                $usuarioAlias    = $request->usuarioAlias;
                $usuarioPassword = $request->usuarioPassword;
                $url             = "/seguridad/usuario/catalogo";

                $bandera = true;
                $mensajes = [];
                $modeloUsuario = $this->modelUsuario;
                $usuario       = $modeloUsuario->obtenerUsuario($usuarioAlias);

                if ($usuario) {
                    //Bloqueo
                    if ($usuario->usuarioEstado == "Bloqueado") {
                        $bandera = false;
                        $mensajes = "Usuario Bloqueado, Favor de Verificar";
                    } else if ($usuario->usuarioEstado == "Inactivo" || $usuario->usuarioEstado == "Desactivado") {
                        $bandera = false;
                        $mensajes = "Usuario Inválido " . $usuarioAlias . ", Favor de Verificar";
                    } else {
                        //Password
                        if (md5($usuarioPassword) != $usuario->usuarioPassword) {
                            $bandera = false;
                            $mensajes = "Credenciales Invalidas, Favor de Verificar($usuario->usuarioIntentos)";
                        }
                    }
                } else {

                    $bandera = false;
                    $mensajes = "Correo electrónico o contraseña incorrectos";
                }

                if ($bandera) {
                    $modeloUsuario->guardarSesion($usuario->idUsuario);

                    return response()->json(['success' => true, 'message' => 'Excelente logueo con éxito.', 'url' => $url]);
                } else {
                    return response()->json(['success' => false, 'required' => true, 'message' => ['usuarioAlias' => [$mensajes]]]);
                }
            }
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}
