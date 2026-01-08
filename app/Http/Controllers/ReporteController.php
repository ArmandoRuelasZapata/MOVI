<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'ubicacion' => 'required|string',
            'tipo_incidencia' => 'nullable|string',
            'recomendaciones' => 'nullable|string',
            'detalles_extra' => 'nullable|string',
            'imagen' => 'nullable|string', // Base64 o URL
        ]);

        $reporte = Reporte::create([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'],
            'ubicacion' => $validated['ubicacion'],
            'tipo_incidencia' => $validated['tipo_incidencia'] ?? null,
            'recomendaciones' => $validated['recomendaciones'] ?? null,
            'detalles_extra' => $validated['detalles_extra'] ?? null,
            'imagen' => $validated['imagen'] ?? null,
            'estatus' => 'atencion', // Estado inicial
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Reporte creado exitosamente',
            'data' => $reporte,
            'folio' => $reporte->id
        ], 201);
    }

    public function index()
    {
        $reportes = Reporte::orderBy('created_at', 'desc')->get();
        return response()->json($reportes);
    }

    public function show($id)
    {
        $reporte = Reporte::findOrFail($id);
        return response()->json($reporte);
    }
    public function edit($id)
{
    $reporte = Reporte::findOrFail($id); // Asegúrate de tener el modelo importado
    return view('reportes.edit', compact('reporte'));
}

public function update(Request $request, $id)
{
    $reporte = Reporte::findOrFail($id);
    
    $request->validate([
        'titulo' => 'required|string|max:255',
        'ubicacion' => 'required|string',
        'descripcion' => 'nullable|string',
        'recomendaciones' => 'nullable|string',
    ]);

    $reporte->update($request->all());

    return redirect()->route('reportes.show', $id)->with('success', 'Los datos del reporte han sido actualizados.');
}
}