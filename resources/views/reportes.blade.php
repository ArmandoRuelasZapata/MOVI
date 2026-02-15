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
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
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
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.status-finalizado { background: #d1fae5; color: #065f46; }
.status-revision { background: #fef3c7; color: #92400e; }
.status-atencion { background: #dbeafe; color: #1e40af; }
.status-pendiente { background: #fee2e2; color: #991b1b; } 

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
    width: 35px;
    height: 35px;
    margin-right: 15px;
    object-fit: contain;
    filter: invert(1);
}

.active .menu-icon {
    filter: invert(0);
}

.loader-container {
    text-align: center;
    padding: 40px;
    color: #666;
}

/* Indicador de conexión en tiempo real */
@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.6; }
    100% { opacity: 1; }
}
.pulse-animation { 
    animation: pulse 2s infinite; 
    font-size: 0.8rem;
    color: #0c8e8a;
    display: flex;
    align-items: center;
    gap: 5px;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endsection

@section('content')
<div class="page-wrapper">
    {{-- Sidebar --}}
    <div class="sidebar">
        <a href="{{ url('home') }}"><img src="{{ asset('img/informe-de-datos.png') }}" class="menu-icon"> Dashboard</a>
        <a href="{{ url('crud') }}"><img src="{{ asset('img/red-mundial.png') }}" class="menu-icon"> Reportes públicos</a>
        <a href="{{ url('reportes') }}" class="active"><img src="{{ asset('img/tus reportes.png') }}" class="menu-icon"> Reportes</a>
        <a href="{{ url('moderadores') }}"><img src="{{ asset('img/proteger.png') }}" class="menu-icon"> Moderadores</a>
        <a href="{{ url('leer-usuarios') }}"><img src="{{ asset('img/admin.png') }}" alt="Moderadores" class="menu-icon"> Administradores</a>
        <a href="{{ url('leer-contactos') }}"><img src="{{ asset('img/contacts.png') }}" alt="Moderadores" class="menu-icon"> Contactos</a>
        <a href="{{ url('cuentasbloqueadas') }}"><img src="{{ asset('img/cuenta-privada.png') }}" class="menu-icon"> Cuentas bloqueadas</a>
        <a href="{{ url('solicitudes') }}"><img src="{{ asset('img/soporte y contacto.png') }}" class="menu-icon"> Solicitudes</a>
    </div>

    {{-- Contenido Principal --}}
    <div class="main-content">
        <div id="alert-container"></div>

        <div class="main-header">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Buscar reporte..." />
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <h2 class="content-title m-0"><strong>Panel de Reportes</strong></h2>
            <span class="pulse-animation fw-bold">
                <i class="fa-solid fa-circle text-success" style="font-size: 0.6rem;"></i> En vivo
            </span>
        </div>

        <div class="content-box">
            <h2 class="report-section-title">Reportes Recientes</h2>

            <ul class="reportes-list" id="reportes-list-container">
                <div class="loader-container">
                    <i class="fa-solid fa-spinner fa-spin fa-2x"></i>
                    <p class="mt-2">Conectando a Firebase...</p>
                </div>
            </ul>
        </div>
    </div>
</div>

<script type="module">
    // Importaciones para tiempo real (onSnapshot)
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.1/firebase-app.js";
    import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.8.1/firebase-analytics.js";
    import { getFirestore, collection, doc, deleteDoc, query, orderBy, onSnapshot } from "https://www.gstatic.com/firebasejs/10.8.1/firebase-firestore.js";

    // Configuración de Firebase
    const firebaseConfig = {
        apiKey: "AIzaSyCfwkyv2JPaHb8u06Ab7VcH2v9QJEwRnmY",
        authDomain: "reportes-proyecto-idor.firebaseapp.com",
        projectId: "reportes-proyecto-idor",
        storageBucket: "reportes-proyecto-idor.firebasestorage.app",
        messagingSenderId: "635696829226",
        appId: "1:635696829226:web:a8b40553eb5b23528b0453",
        measurementId: "G-MTW7NZ53DN"
    };

    // Inicializar Firebase
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app); 
    const db = getFirestore(app);
    
    const coleccionReportes = "reportes"; 
    const listContainer = document.getElementById('reportes-list-container');
    const alertContainer = document.getElementById('alert-container');

    // Inicializar el escuchador en tiempo real
    function iniciarEscuchaTiempoReal() {
        const q = query(collection(db, coleccionReportes), orderBy("created_at", "desc"));
        
        // onSnapshot reemplaza a getDocs y actualiza automáticamente
        onSnapshot(q, (querySnapshot) => {
            listContainer.innerHTML = ''; 

            if (querySnapshot.empty) {
                listContainer.innerHTML = `
                    <li class="reportes-list-item">
                        <div class="report-details" style="text-align: center; color: #999; width: 100%;">
                            <i class="fa-solid fa-inbox fa-2x mb-2" style="opacity: 0.5;"></i><br>
                            No hay reportes generados desde la aplicación aún.
                        </div>
                    </li>`;
                return;
            }

            querySnapshot.forEach((docSnap) => {
                const reporte = docSnap.data();
                const id = docSnap.id; 
                
                let fechaFormateada = "Sin fecha";
                if(reporte.created_at) {
                    const dateObj = reporte.created_at.toDate ? reporte.created_at.toDate() : new Date(reporte.created_at);
                    fechaFormateada = `${dateObj.getHours().toString().padStart(2, '0')}:${dateObj.getMinutes().toString().padStart(2, '0')} - ${dateObj.getDate().toString().padStart(2, '0')}/${(dateObj.getMonth()+1).toString().padStart(2, '0')}/${dateObj.getFullYear()}`;
                }

                const titulo = reporte.titulo || "Sin título";
                const ubicacion = reporte.ubicacion || "Sin ubicación";
                const estatus = reporte.estatus || "Pendiente";
                
                const statusSlug = estatus.toLowerCase().replace(/\s+/g, '-');

                const li = document.createElement('li');
                li.className = "reportes-list-item d-flex justify-content-between align-items-center";
                
                // Se agregó cursor-pointer al contenedor para mejor UX
                li.innerHTML = `
                    <div class="d-flex align-items-center flex-grow-1" onclick="window.location.href = '{{ url('reportes') }}/${id}'" style="cursor: pointer;">
                        <span class="report-icon"><i class="fa-solid fa-file-shield"></i></span>
                        <div class="report-details">
                            <div class="report-name">
                                Reporte #${id.substring(0, 5).toUpperCase()} <small class="text-muted fw-normal ms-2">(${fechaFormateada})</small>
                                <span class="status-badge status-${statusSlug}">
                                    ${estatus}
                                </span>
                            </div>
                            <div class="report-meta">
                                <strong>Título:</strong> ${titulo} | <strong>Ubicación:</strong> ${ubicacion}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center" style="position: relative; z-index: 10;">
                        <button type="button" class="btn-delete-report btn-eliminar-fb" data-id="${id}" title="Eliminar Reporte">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                        <i class="fa-solid fa-chevron-right ms-2" style="color: #ccc;"></i>
                    </div>
                `;
                
                listContainer.appendChild(li);
            });

            // Asignar eventos de eliminación a los nuevos botones
            document.querySelectorAll('.btn-eliminar-fb').forEach(btn => {
                btn.addEventListener('click', async (e) => {
                    e.stopPropagation(); 
                    const docId = e.currentTarget.getAttribute('data-id');
                    if (confirm('¿Deseas eliminar este reporte permanentemente?')) {
                        await eliminarReporte(docId);
                    }
                });
            });

        }, (error) => {
            console.error("Error escuchando reportes:", error);
            listContainer.innerHTML = `<div class="p-4 text-center text-danger">Error al cargar los datos desde Firebase. Verifica tu conexión o el índice de Firestore.</div>`;
        });
    }

    // Función de eliminación
    // Ya no es necesario llamar a cargarReportes() aquí, onSnapshot lo hará solo
    async function eliminarReporte(id) {
        try {
            await deleteDoc(doc(db, coleccionReportes, id));
            mostrarAlerta("Reporte eliminado exitosamente.");
        } catch (error) {
            console.error("Error al eliminar:", error);
            mostrarAlerta("Error al eliminar el reporte.", "danger");
        }
    }

    // Mostrar notificaciones
    function mostrarAlerta(mensaje, tipo = "success") {
        alertContainer.innerHTML = `
            <div class="alert alert-${tipo} alert-dismissible fade show" role="alert">
                <i class="fa-solid ${tipo === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation'}"></i> ${mensaje}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        setTimeout(() => { alertContainer.innerHTML = ''; }, 4000);
    }

    // Iniciar escucha cuando cargue la página
    window.onload = iniciarEscuchaTiempoReal;

</script>
@endsection