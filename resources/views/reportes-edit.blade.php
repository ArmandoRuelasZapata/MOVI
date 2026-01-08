@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
            <h2 class="mb-0 h4 text-uppercase fw-bold text-secondary">Editar Reporte #{{ $reporte->id }}</h2>
            <a href="{{ route('reportes.show', $reporte->id) }}" class="btn btn-outline-secondary btn-sm">
                <i class="fa-solid fa-xmark"></i> Cancelar
            </a>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('reportes.update', $reporte->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- Título --}}
                    <div class="col-md-6 mb-4">
                        <label class="fw-bold text-secondary text-uppercase small">Título del Reporte</label>
                        <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" 
                               value="{{ old('titulo', $reporte->titulo) }}" required>
                        @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Ubicación --}}
                    <div class="col-md-6 mb-4">
                        <label class="fw-bold text-secondary text-uppercase small">Ubicación</label>
                        <input type="text" name="ubicacion" class="form-control @error('ubicacion') is-invalid @enderror" 
                               value="{{ old('ubicacion', $reporte->ubicacion) }}" required>
                        @error('ubicacion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Descripción --}}
                    <div class="col-md-12 mb-4">
                        <label class="fw-bold text-secondary text-uppercase small">Descripción del incidente</label>
                        <textarea name="descripcion" class="form-control" rows="4">{{ old('descripcion', $reporte->descripcion) }}</textarea>
                    </div>

                    {{-- Recomendaciones --}}
                    <div class="col-md-12 mb-4">
                        <label class="fw-bold text-secondary text-uppercase small">Recomendaciones para usuarios</label>
                        <textarea name="recomendaciones" class="form-control" rows="3">{{ old('recomendaciones', $reporte->recomendaciones) }}</textarea>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">
                        <i class="fa-solid fa-floppy-disk"></i> GUARDAR CAMBIOS
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection