@extends('layouts.app')

@section('styles')
<style>
    body {
        background: #f2f4f7;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    
    .page-wrapper {
        display: flex;
        flex-grow: 1;
    }

    /* === SIDEBAR === */
    .sidebar {
        width: 260px;
        min-height: calc(100vh - 66px);
        position: sticky;
        top: 66px;
        left: 0;
        background: #0c8e8a;
        border-right: 1px solid #086b6a;
        padding-top: 10px;
    }
    
    .sidebar a {
        display: flex;
        align-items: center;
        padding: 14px 20px;
        color: white;
        font-size: 16px;
        text-decoration: none;
        transition: 0.2s;
    }

    .sidebar a:hover {
        background: #086b6a;
    }

    .sidebar a.active {
        background: #f2f4f7;
        color: #333;
        border-radius: 4px;
        margin: 0 10px;
    }

    /* === MAIN CONTENT === */
    .main-content {
        flex-grow: 1;
        padding: 30px;
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .content-box {
        background: #ffffff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        overflow-y: auto;
        max-height: 600px;
    }
    
    .report-section-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .reportes-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .reportes-list-item {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
        transition: background 0.2s;
        cursor: pointer;
    }

    .reportes-list-item:last-child {
        border-bottom: none;
    }

    .reportes-list-item:hover {
        background-color: #f9f9f9;
    }

    .report-icon {
        font-size: 1.5em; 
        color: #0c8e8a;
        margin-right: 15px;
        width: 30px;
        text-align: center;
    }
    
    .report-details {
        flex-grow: 1;
    }

    .report-name {
        font-size: 1rem;
        color: #333;
        font-weight: 500;
    }

    .report-meta {
        font-size: 0.85rem;
        color: #777;
    }

    /* === BADGES & BUTTONS === */
    .status-badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.70rem;
        font-weight: bold;
        text-transform: uppercase;
        margin-left: 10px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .status-finalizado { background: #d1fae5; color: #065f46; }
    .status-revision { background: #fef3c7; color: #92400e; }
    .status-atencion { background: #dbeafe; color: #1e40af; }

    .btn-delete-report {
        color: #dc3545;
        background: transparent;
        border: none;
        padding: 8px;
        margin-left: 10px;
        transition: 0.2s;
        cursor: pointer;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-delete-report:hover {
        background: #fff5f5;
        color: #a71d2a;
        transform: scale(1.15);
    }

    .main-header {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    .search-box input {
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 250px;
    }

    .menu-icon {
        width: 25px;
        height: 25px;
        margin-right: 15px;
        object-fit: contain;
        filter: invert(1);
    }

    .active .menu-icon {
        filter: invert(0);
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endsection

@section('content')
<div class="page-wrapper">
    {{-- Sidebar --}}
    <div class="sidebar">
        <a href="#"><img src="{{ asset('img/informe-de-datos.png') }}" class="menu-icon"> Dashboard</a>
        <a href="{{ url('crud') }}"><img src="{{ asset('img/red-mundial.png') }}" class="menu-icon"> Reportes públicos</a>
        <a href="{{ url('reportes') }}" class="active"><img src="{{ asset('img/tus reportes.png') }}" class="menu-icon"> Reportes</a>
        <a href="{{ url('moderadores') }}"><img src="{{ asset('img/proteger.png') }}" class="menu-icon"> Moderadores</a>
        <a href="{{ url('cuentasbloqueadas') }}"><img src="{{ asset('img/cuenta-privada.png') }}" class="menu-icon"> Cuentas bloqueadas</a>
        <a href="{{ url('solicitudes') }}"><img src="{{ asset('img/soporte y contacto.png') }}" class="menu-icon"> Solicitudes</a>
    </div>

    {{-- Contenido Principal --}}
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="main-header">
            <div class="search-box">
                <input type="text" placeholder="Buscar reporte..." />
            </div>
        </div>

        <h2 class="content-title"><strong>Panel de Reportes</strong></h2>

        <div class="content-box">
            <h2 class="report-section-title">Reportes RecientesZ</h2> 
            
            <ul class="reportes-list">
                @forelse($reportes as $reporte)
                    <li class="reportes-list-item d-flex justify-content-between align-items-center" 
                        onclick="window.location='{{ url('reportes/'.$reporte->id) }}'">
                        
                        <div class="d-flex align-items-center flex-grow-1">
                            <span class="report-icon"><i class="fa-solid fa-file-shield"></i></span>
                            <div class="report-details">
                                <div class="report-name">
                                    Reporte #{{ $reporte->id }}_{{ $reporte->created_at->format('H:i') }}_{{ $reporte->created_at->format('d/m/Y') }}
                                    <span class="status-badge {{ 'status-'.Str::slug($reporte->estatus) }}">
                                        {{ $reporte->estatus }}
                                    </span>
                                </div>
                                <div class="report-meta">
                                    <strong>Título:</strong> {{ $reporte->titulo }} | <strong>Ubicación:</strong> {{ $reporte->ubicacion }}
                                </div>
                            </div>
                        </div>

                        {{-- Acciones (Borrar) --}}
                        <div class="d-flex align-items-center" style="position: relative; z-index: 10;">
                            <form action="{{ route('reportes.destroy', $reporte->id) }}" method="POST" 
                                  onsubmit="return confirm('¿Deseas eliminar este reporte permanentemente?');"
                                  onclick="event.stopPropagation();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete-report" title="Eliminar Reporte">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                            <i class="fa-solid fa-chevron-right ms-2" style="color: #ccc;"></i>
                        </div>
                    </li>
                @empty
                    <li class="reportes-list-item">
                        <div class="report-details" style="text-align: center; color: #999; width: 100%;">
                            No hay reportes generados desde la aplicación aún.
                        </div>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection