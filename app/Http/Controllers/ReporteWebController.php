<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use Illuminate\Http\Request;

class ReporteWebController extends Controller
{
    public function index()
    {
        $reportes = Reporte::orderBy('created_at', 'desc')->get();
        return view('reportes', compact('reportes'));
    }

    public function show($id) 
    {
        $reporte = Reporte::findOrFail($id);
        return view('reportes-show', compact('reporte'));
    }

    // --- NUEVOS MÉTODOS PARA EDITAR ---

    public function edit($id)
    {
        $reporte = Reporte::findOrFail($id);
        // Asegúrate de que el archivo sea 'reportes-edit.blade.php' 
        // o ajusta el nombre según lo crees en resources/views
        return view('reportes-edit', compact('reporte'));
    }

    public function update(Request $request, $id)
    {
        $reporte = Reporte::findOrFail($id);
        
        // Validación básica
        $request->validate([
            'titulo' => 'required|string|max:255',
            'ubicacion' => 'required|string',
            'descripcion' => 'nullable|string',
            'recomendaciones' => 'nullable|string',
        ]);

        // Actualiza los datos
        $reporte->update($request->only([
            'titulo', 
            'ubicacion', 
            'descripcion', 
            'recomendaciones'
        ]));

        return redirect()->route('reportes.show', $id)
                         ->with('success', 'Los datos del reporte han sido actualizados.');
    }

    // ----------------------------------

    public function updateStatus(Request $request, $id)
    {
        $reporte = Reporte::findOrFail($id);
        $reporte->estatus = $request->estatus;
        $reporte->save();

        return back()->with('success', 'El estatus del reporte ha sido actualizado.');
    }

    public function destroy($id)
{
    $reporte = Reporte::findOrFail($id);
    $reporte->delete();

    return back()->with('success', 'El reporte ha sido eliminado permanentemente.');
}
}