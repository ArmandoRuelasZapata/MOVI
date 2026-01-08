<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function users(){
        $usuarios = User::all();
        return view('users', compact('usuarios'));
    }
    public function crud(){
        return view('crud');
    }
    public function reportes(){
        return view('reportes');
    }
    public function moderadores(){
        return view('moderadores');
    }
    public function cuentasBloqueadas(){
        return view('cuentasbloqueadas');
    }
    public function solicitudes(){
        return view('solicitudes');
    }



}