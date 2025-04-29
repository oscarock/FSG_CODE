<?php

namespace App\Http\Controllers\Seguridad;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UsuarioController extends Controller
{

    public function catalogo()
    {
        return view("modulos.seguridad.usuario.catalogo");
    }
}
