<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FirebaseAuthController extends Controller
{
    public function syncSession(Request $request)
    {
        $token = $request->input('token');

        if (!$token) {
            return response()->json(['error' => 'Token no proporcionado'], 400);
        }

        try {
            // 1. Validamos el token con Firebase
            $auth = Firebase::auth();
            $verifiedIdToken = $auth->verifyIdToken($token);

            // 2. Obtenemos los datos del usuario desde el token
            $email = $verifiedIdToken->claims()->get('email');
            
            // Firebase a veces no envía el nombre si se registraron solo con correo,
            // así que le damos un valor por defecto o extraemos parte del correo
            $name = $verifiedIdToken->claims()->get('name') ?? explode('@', $email)[0]; 

            // 3. Sincronizamos con nuestra base de datos local
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => bcrypt(Str::random(16)) // Ignorado, pero Laravel lo requiere
                ]
            );

            // 4. Iniciamos la sesión en Laravel
            Auth::login($user);

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error de Firebase: ' . $e->getMessage()], 401);
        }
    }
}