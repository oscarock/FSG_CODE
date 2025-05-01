<?php

namespace App\Http\Controllers\Seguridad;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Seguridad\Usuario;


class UsuarioController extends Controller
{

    public function catalogo()
    {
       
        $usuario = auth()->user();
        $usuarios = Usuario::all();
        return view("modulos.seguridad.usuario.catalogo", compact('usuario', 'usuarios'));
    }

    public function formularioFoto($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('modulos.seguridad.usuario.subir_foto', compact('usuario'));
    }

    public function subirFoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $usuario = Usuario::findOrFail($id);

        // Guardar imagen
        if ($request->hasFile('foto')) {
            $filename = Str::uuid() . '.' . $request->foto->extension();
            $path = $request->foto->move(public_path('fotos_usuarios'), $filename);

            // Opcional: eliminar foto anterior
            if ($usuario->usuarioFoto) {
                $rutaAnterior = public_path('fotos_usuarios/' . $usuario->usuarioFoto);
                if (file_exists($rutaAnterior)) {
                    unlink($rutaAnterior);
                }
            }

            $usuario->usuarioFoto = $filename;
            $usuario->save();

            return redirect()->route('usuarios.catalogo', $id)
                            ->with('success', 'Imagen subida correctamente.');
        }

        return back()->with('error', 'Hubo un problema al subir la imagen.');
    }
}
