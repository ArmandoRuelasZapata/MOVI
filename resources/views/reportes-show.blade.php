@extends('layouts.app')

@section('content')
<div class="container mt-5">
    {{-- Mensaje de éxito tras actualizar --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
            <h2 class="mb-0 h4 text-uppercase fw-bold text-secondary">Detalle del Reporte #{{ $reporte->id }}</h2>
            
            <div class="d-flex gap-2"> {{-- Contenedor para botones --}}
                <a href="{{ route('reportes.edit', $reporte->id) }}" class="btn btn-warning btn-sm fw-bold shadow-sm">
                    <i class="fa-solid fa-pen-to-square"></i> Editar
                </a>
                <a href="{{ url('/reportes') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa-solid fa-arrow-left"></i> Volver al listado
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold m-0">{{ $reporte->titulo }}</h3>
                {{-- Badge de estado dinámico --}}
                <span class="badge rounded-pill p-2 px-4 shadow-sm
                    @if($reporte->estatus == 'Finalizado') bg-success 
                    @elseif($reporte->estatus == 'Revisión') bg-warning text-dark 
                    @else bg-primary @endif">
                    <i class="fa-solid fa-circle-info"></i> {{ $reporte->estatus }}
                </span>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <p class="mb-1 text-muted small text-uppercase">Fecha de recepción</p>
                    <p class="fw-bold"><i class="fa-regular fa-calendar-days text-primary"></i> {{ $reporte->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted small text-uppercase">Tipo de incidencia</p>
                    <p class="fw-bold text-capitalize"><i class="fa-solid fa-triangle-exclamation text-danger"></i> {{ str_replace('_', ' ', $reporte->tipo_incidencia) }}</p>
                </div>
                <div class="col-md-12">
                    <p class="mb-1 text-muted small text-uppercase">Ubicación</p>
                    <p class="fw-bold"><i class="fa-solid fa-location-dot text-success"></i> {{ $reporte->ubicacion }}</p>
                </div>
            </div>

            <hr class="text-light">

            <div class="row">
                <div class="col-md-7">
                    <p class="fw-bold text-secondary text-uppercase small">Descripción del incidente</p>
                    <div class="p-3 bg-light border rounded mb-4 shadow-sm" style="min-height: 100px;">
                        {{ $reporte->descripcion ?? 'Sin descripción disponible.' }}
                    </div>

                    <p class="fw-bold text-secondary text-uppercase small">Recomendaciones para usuarios</p>
                    <p class="p-3 border-start border-4 border-info bg-light rounded shadow-sm">
                         {{ $reporte->recomendaciones }}
                    </p>

                    @if($reporte->detalles_extra)
                    <p class="fw-bold text-secondary text-uppercase small">Más detalles</p>
                    <p class="text-muted small bg-light p-2 rounded border">{{ $reporte->detalles_extra }}</p>
                    @endif
                </div>

                <div class="col-md-5">
                    <p class="fw-bold text-secondary text-uppercase small">Evidencia Fotográfica</p>
                    <div class="text-center bg-light border rounded p-2 shadow-sm">
                        @if($reporte->imagen)
                        <img src="{{ $reporte->imagen }}" 
                             alt="Evidencia del reporte" 
                             class="img-fluid rounded shadow-sm"
                             style="max-height: 350px; width: 100%; object-fit: cover; cursor: zoom-in;"
                             >
                        
                        @else
                        <div class="p-5 text-muted">
                            <i class="fa-solid fa-image-slash fa-3x mb-3 opacity-25"></i><br>
                            No hay evidencia fotográfica disponible.
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <hr class="my-4">

            {{-- Sección de Gestión --}}
            <div class="bg-light p-4 rounded border shadow-sm">
                <h5 class="mb-4 text-center text-uppercase fw-bold text-muted">Panel de Gestión de Estatus</h5>
                <form action="{{ route('reportes.updateStatus', $reporte->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="btn-group w-100 shadow-sm" role="group">
                        <button type="submit" name="estatus" value="Atención"
                            class="btn btn-outline-primary py-3 fw-bold {{ $reporte->estatus == 'Atención' ? 'active' : '' }}">
                            <i class="fa-solid fa-clock"></i> EN ATENCIÓN
                        </button>

                        <button type="submit" name="estatus" value="Revisión"
                            class="btn btn-outline-warning py-3 fw-bold {{ $reporte->estatus == 'Revisión' ? 'active' : '' }}">
                            <i class="fa-solid fa-magnifying-glass"></i> EN REVISIÓN
                        </button>

                        <button type="submit" name="estatus" value="Finalizado"
                            class="btn btn-outline-success py-3 fw-bold {{ $reporte->estatus == 'Finalizado' ? 'active' : '' }}">
                            <i class="fa-solid fa-check-double"></i> FINALIZADO
                        </button>
                    </div>
                    <p class="text-center text-muted mt-3 mb-0 small italic">
                        <i class="fa-solid fa-circle-exclamation"></i> Al seleccionar un nuevo estatus, los cambios se reflejarán inmediatamente en la aplicación móvil.
                    </p>
                </form>
            </div>
        </div>

        <div class="card-footer bg-white text-muted d-flex justify-content-between py-3">
            <span class="small"><strong>Folio:</strong> #{{ $reporte->id }}</span>
            <span class="small"><strong>Sincronizado:</strong> {{ $reporte->updated_at->diffForHumans() }}</span>
        </div>
    </div>
</div>
@endsection