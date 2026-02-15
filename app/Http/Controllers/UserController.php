<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Muestra el formulario de creación exclusivo para Administradores.
     * Importante: Usa una vista diferente a la de registro público.
     */
    public function create()
    {
        // Cambiamos de 'auth.register' a 'auth.create-user'
        return view('auth.create-user'); 
    }

    /**
     * Guarda el nuevo usuario sin cerrar la sesión del administrador actual.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->to('leer-usuarios')->with('success', 'Nuevo administrador creado correctamente.');
    }

    /**
     * Muestra el formulario de edición.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edit-blade', compact('user')); 
    }

    /**
     * Actualiza los datos del usuario.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->to('leer-usuarios')->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Elimina un usuario.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('status', 'Usuario eliminado correctamente');
    }
}