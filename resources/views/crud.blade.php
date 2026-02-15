@extends('layouts.app')

@section('styles')
<style>
    /* Aseguramos que el body esté en el color deseado y que el contenido principal sea flexible */
    body {
        background: #f2f4f7;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    
    /* === Layout de dos columnas después del Header === */
    .page-wrapper {
        display: flex;
        flex-grow: 1; /* Para que ocupe el espacio restante */
    }

    /* === SIDEBAR (Barra de Navegación Vertical) === */
    .sidebar {
        width: 260px;
        /* La altura se ajusta al contenido o al viewport, ya no es 100vh porque el header está arriba */
        min-height: calc(100vh - 66px); /* 100vh menos la altura aproximada de la navbar */
        position: sticky; /* Sticky para que se quede al hacer scroll, o fixed si quieres que se quede pegado */
        top: 66px; /* Bajamos el sidebar justo debajo de la navbar */
        left: 0;
        background: #0b7a83; /* Color de tu segunda imagen, pero vamos a usar el color del header si es #0c8e8a, la segunda imagen parece ser una tonalidad un poco diferente, si quieres el color del header original usa #0c8e8a */
        background: #0c8e8a; /* Color del header original para consistencia */
        border-right: 1px solid #086b6a;
        padding-top: 10px;
    }
    
    .sidebar a {
        display: flex;
        align-items: center;
        padding: 14px 20px;
        color: white; /* Texto blanco para el color de fondo */
        font-size: 16px;
        text-decoration: none;
        transition: 0.2s;
    }

    .sidebar a:hover {
        background: #086b6a; /* Un color ligeramente más oscuro al pasar el ratón */
    }

    .sidebar a.active {
        background: #f2f4f7; /* Fondo gris claro como en la Imagen 2 */
        color: #333; /* Texto oscuro para el fondo claro */
        border-radius: 4px;
        margin: 0 10px;
    }

    /* === CONTENT (Contenido Principal) === */
    .main-content {
        flex-grow: 1; /* Ocupa el espacio restante */
        padding: 30px;
        padding-left: 20px; /* Ajustamos padding si es necesario */
    }

    .content-box {
        background: #ffffff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    /* Estilos para la lista/tabla de reportes (simulando la imagen 2) */
    .reportes-list {
        list-style: none;
        padding: 0;
    }

    .reportes-list-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .reportes-list-item:last-child {
        border-bottom: none;
    }

    .reportes-list-item img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        margin-right: 15px;
        border-radius: 4px;
    }

    .report-details {
        flex-grow: 1;
    }

    .report-title {
        font-weight: bold;
        margin-bottom: 2px;
    }

    .report-type {
        font-size: 0.9em;
        color: #666;
    }

    .report-actions {
        display: flex;
        gap: 10px;
    }

    .report-actions button {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 1.2em;
        color: #555;
    }

    .report-actions button:hover {
        color: #0c8e8a;
    }
    
    .filter-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .filter-options {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .search-box input {
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .menu-icon {
    width: 35px;
    height: 35px;
    margin-right: 15px;
    object-fit: contain;
    filter: invert();
}
.active img {
    filter: invert(0);
}
</style>
@endsection

@section('content')

<div class="page-wrapper">

    <div class="sidebar">
        <a href="{{ url("home") }}"><img src="{{ asset('img/informe-de-datos.png') }}" alt="Icono Reportes" class="menu-icon">
            Dashboard</a>
        <a href="{{ url("crud") }}" class="active">
            <img src="{{ asset('img/red-mundial.png') }}" alt="red-mundial" class="menu-icon">
            Reportes públicos
        </a>
        <a href="{{ url('reportes') }}"> <img src="{{ asset('img/tus reportes.png') }}" alt="Icono Reportes" class="menu-icon">
            Reportes</a>
        <a href="{{ url("moderadores") }}"><img src="{{ asset('img/proteger.png') }}" alt="Icono Reportes" class="menu-icon">
            Moderadores</a>
            <a href="{{ url('leer-usuarios') }}">
            <img src="{{ asset('img/admin.png') }}" alt="Moderadores" class="menu-icon">
            Administradores
        </a>
        <a href="{{ url("leer-contactos") }}">
            <img src="{{ asset('img/contacts.png') }}" alt="Moderadores" class="menu-icon">
            Contactos
        </a>
        <a href="{{ url("cuentasbloqueadas") }}"><img src="{{ asset('img/cuenta-privada.png') }}" alt="Icono Reportes" class="menu-icon">
            Cuentas bloqueadas</a>
        <a href="{{ url("solicitudes") }}"><img src="{{ asset('img/soporte y contacto.png') }}" alt="Icono Reportes" class="menu-icon">
            Solicitudes</a>
    </div>

    <div class="main-content">

        <div class="content-box">
            
            <div class="filter-bar">
                <div class="search-box">
                    <input type="text" placeholder="Buscar..." />
                </div>
                <div class="filter-options">
                    <span>Filtrar:</span>
                    <label for="fecha-filter">Fecha</label>
                    <select id="fecha-filter">
                        <option>Hoy</option>
                        <option>Ayer</option>
                    </select>
                    
                    <label for="tipo-incidencia-filter">Tipo Incidencia</label>
                    <select id="tipo-incidencia-filter">
                        <option>Accidente</option>
                        <option>Bache</option>
                    </select>
                </div>
            </div>

            <h2 class="mb-4"><strong>Reportes públicos</strong></h2>
            
            <ul class="reportes-list">
                
                {{-- Elemento 1: Accidente --}}
                <li class="reportes-list-item">
                                        <div class="report-details">
                        <div class="report-title">Colision de autos termina en incendio vehicular</div>
                        <div class="report-type">Accidente</div>
                    </div>
                    <div class="report-actions">
                        <button title="Editar"><i class="fa-solid fa-pencil"></i></button>
                        <button title="Ver"><i class="fa-solid fa-eye"></i></button>
                        <button title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </li>
                
                {{-- Elemento 2: Bache --}}
                <li class="reportes-list-item">
                                        <div class="report-details">
                        <div class="report-title">Bache en Av. 20 de noviembre</div>
                        <div class="report-type">Bache</div>
                    </div>
                    <div class="report-actions">
                        <button title="Editar"><i class="fa-solid fa-pencil"></i></button>
                        <button title="Ver"><i class="fa-solid fa-eye"></i></button>
                        <button title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </li>
                
                {{-- Puedes añadir más elementos aquí... --}}
            </ul>

        </div>

    </div>

</div>

@endsection