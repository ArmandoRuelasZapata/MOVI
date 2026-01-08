@extends('layouts.master')
@section('content')
<div class= "container">
    <h1 class= "h2">Contacto</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!! Hay algunos errores</strong>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{url('guardar-contacto') }}">
        @csrf
        <div class= "row mb-2">
            <div class="col md-4">
                <label for="nombre" class="form-label">Nombre</label>
                <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Introduce un nombre">
            </div>
            <div class="col md-4">
                <label for="email" class="form-label">Correo electrónico</label>
                <input class="form-control" type="email" id="email" name="correo" placeholder="Introduce un correo">
            </div>
            <div class="col md-4">
                <label for="prioridad"class="forml-label">Prioridad</label>
                <select class="form-control" name="prioridad" id="prioridad">
                    <option value="" disabled>Elige una opción</option>
                    <option value="alta">Alta</option>
                    <option value="media">Media</option>
                    <option value="baja">Baja</option>
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col mb-12">
                <label for="asunto" class="form-label">Asunto</label>
                <input class="form-control" id="asunto" type="text" name="asunto"placeholder="Añade un asunto">
            </div>
            <div class="col mb-12">
                <label for="mensaje" clas="form-label">Mensaje</label>
                <textarea class="form-control" name="mensaje" id="mensaje" placeholder="Agrega un mensaje">
                </textarea>
            </div>
        </div>
        <button type="submit" class="btn w-100" style="background-color: #088331ff; color: white;">Enviar</button>

    </form>
</div>

@endsection