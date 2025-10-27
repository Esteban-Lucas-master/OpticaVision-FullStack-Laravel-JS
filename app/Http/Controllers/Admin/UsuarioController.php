<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UsuarioController extends BaseController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $usuarios = $this->userService->getAllUsers();
        return view('admin.usuarios', compact('usuarios'));
    }

    public function cambiarRol(Request $request, $id)
    {
        $request->validate([
            'rol' => 'required|in:cliente,vendedor,admin'
        ]);

        $usuario = $this->userService->findUserById($id);
        if (!$usuario) {
            return redirect()->route('admin.usuarios.index')->with('error', 'Usuario no encontrado');
        }

        $this->userService->updateUserRole($usuario, $request->rol);

        return redirect()->route('admin.usuarios.index')->with('success', 'Rol actualizado correctamente');
    }
}