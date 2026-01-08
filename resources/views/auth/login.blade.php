@extends('layouts.app')
@section('content')
</style>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="w-full flex justify-center items-center py-16 px-4 bg-gray-100 min-h-screen">

    <!-- CARD -->
    <div class="bg-white shadow-2xl rounded-2xl w-full max-w-sm p-8 border border-gray-200">
        
        <!-- LOGO -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/logoMOVI.png') }}" alt="Logo" class="w-20 h-20">
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="Username or email"
                    class="w-full px-4 py-3 rounded-md border border-gray-300 
                    focus:ring-2 focus:ring-[#087D83] focus:outline-none 
                    @error('email') border-red-500 @enderror">
                
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <input id="password" type="password" name="password" required placeholder="Password"
                    class="w-full px-4 py-3 rounded-md border border-gray-300 
                    focus:ring-2 focus:ring-[#087D83] focus:outline-none 
                    @error('password') border-red-500 @enderror">

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mb-4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-[#087D83] hover:underline">
                        Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <button type="submit"
                class="w-full bg-[#087D83] text-white py-3 rounded-md hover:bg-[#066e72] transition-all">
                Iniciar sesión
            </button>

            <p class="text-center text-gray-500 text-sm mt-6">
                Aún no tienes una cuenta?
                <a href="{{ route('register') }}" class="text-[#087D83] hover:underline">Registrarse</a>
            </p>
        </form>

    </div>
</div>
</body>

</html>

@endsection