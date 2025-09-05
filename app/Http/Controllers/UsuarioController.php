<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    // Mostrar lista de usuarios
    public function index()
    {
        $usuarios = User::all(); // Trae todos los usuarios
        return view('admin.usuarios', compact('usuarios'));
    }

    // Cambiar rol de un usuario
    public function cambiarRol(Request $request, $id)
    {
        $request->validate([
            'rol' => 'required|in:cliente,vendedor,admin'
        ]);

        $usuario = User::findOrFail($id);
        $usuario->rol = $request->rol;
        $usuario->save();

        return redirect()->route('admin.usuarios')->with('success', 'Rol actualizado correctamente');
    }
}
