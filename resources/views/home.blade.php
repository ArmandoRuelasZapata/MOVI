@extends('layouts.app')

@section('content')
<div class="container">
    {{-- CARD DEL DASHBOARD --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border-radius: 15px; background-color: #ffffff;">
                <div class="card-header" style="background-color: #0A9A9E; color: white; border-radius: 15px 15px 0 0;">
                    {{ __('Dashboard') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Haz iniciado sesión!') }}
                </div>
            </div>
        </div>
    </div>

    {{-- MENU CON ACORDEON --}}
    <div class="row mt-4 justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border-radius: 15px; background-color: #ffffff;">
                {{-- Opciones del menú --}}
                <div class="list-group list-group-flush">
                    {{-- Opción 1 (Inicio) --}}
                    <a href="{{ route('home') }}"
                       class="list-group-item list-group-item-action d-flex align-items-center"
                       style="background-color: #f0f0f0; border-radius: 15px; margin-bottom: 5px;">
                        <img src="{{ asset('img/inicio.png') }}" 
                             alt="Icono Inicio" 
                             class="me-3" 
                             style="width: 24px; height: 24px;">
                        <span style="color: #0A9A9E;">Inicio</span>
                    </a>

                    {{-- Opción 2 (Tus reportes) con acordeón --}}
                    <a href="#reportes" data-bs-toggle="collapse"
                       class="list-group-item list-group-item-action d-flex align-items-center"
                       style="background-color: #f0f0f0; border-radius: 15px; margin-bottom: 5px;">
                        <img src="{{ asset('img/tus reportes.png') }}" 
                             alt="Icono Reportes" 
                             class="me-3" 
                             style="width: 24px; height: 24px;">
                        <span style="color: #0A9A9E;">Tus reportes</span>
                    </a>
                    <div id="reportes" class="collapse">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                <img src="{{ asset('img/tus reportes.png') }}" alt="Icono Reporte" class="me-3" style="width: 24px; height: 24px;">
                                <span>Reporte #01_17:02_11/11/2025</span>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                <img src="{{ asset('img/tus reportes.png') }}" alt="Icono Reporte" class="me-3" style="width: 24px; height: 24px;">
                                <span>Reporte #02_22:15_12/11/2025</span>
                            </a>
                        </div>
                    </div>

                    {{-- Opción 3 (Soporte y contacto) con acordeón --}}
                    <a href="#soporte" data-bs-toggle="collapse"
                       class="list-group-item list-group-item-action d-flex align-items-center"
                       style="background-color: #f0f0f0; border-radius: 15px; margin-bottom: 5px;">
                        <img src="{{ asset('img/soporte y contacto.png') }}" 
                             alt="Icono Soporte" 
                             class="me-3" 
                             style="width: 24px; height: 24px;">
                        <span style="color: #0A9A9E;">Soporte y contacto</span>
                    </a>
                    <div id="soporte" class="collapse">
                        <div class="list-group">
                            {{-- Preguntas frecuentes --}}
                            <a href="#" class="list-group-item list-group-item-action">
                                <strong>¿Cómo puedo reportar un accidente o daño en la vía pública desde la app?</strong>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <strong>¿Qué hago si la aplicación no detecta correctamente mi ubicación?</strong>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <strong>La aplicación se cierra sola o presenta errores, ¿qué puedo hacer?</strong>
                            </a>

                            {{-- Chat con soporte técnico --}}
                            <a href="#contactar-soporte" class="list-group-item list-group-item-action">
                                <span>Chat con soporte técnico</span>
                            </a>

                            {{-- Sección de contacto --}}
                            <div id="contactar-soporte" class="collapse">
                                <p>Comunícate con uno de nuestros técnicos para brindarte ayuda sobre tu problema.</p>
                                <a href="#" class="btn btn-primary" style="background-color: #0A9A9E; border-color: #0A9A9E;">Contáctanos</a>
                            </div>
                        </div>
                    </div>

                    {{-- Opción 4 (Acerca de) --}}
                    <a href="#acerca-de" data-bs-toggle="collapse"
                       class="list-group-item list-group-item-action d-flex align-items-center"
                       style="background-color: #f0f0f0; border-radius: 15px; margin-bottom: 5px;">
                        <img src="{{ asset('img/acerca de.png') }}" 
                             alt="Icono Acerca de" 
                             class="me-3" 
                             style="width: 24px; height: 24px;">
                        <span style="color: #0A9A9E;">Acerca de</span>
                    </a>
                    <div id="acerca-de" class="collapse">
                        <div class="list-group">
                            <p class="list-group-item">
                                En esta aplicación, nuestra misión es mejorar la seguridad y eficiencia vial proporcionando información actualizada sobre el estado de las vías. Facilitamos a la ciudadanía el acceso a datos relevantes y la posibilidad de reportar incidencias en tiempo real, contribuyendo así a una mejor toma de decisiones por parte de las autoridades.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection