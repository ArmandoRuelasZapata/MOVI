@extends('layouts.app')

@section('content')
{{-- CARD PRINCIPAL --}}
<div class="row justify-content-center">
    <div class="col-md-10">

        <div class="card shadow-sm" style="border-radius: 15px; background-color: #ffffff;">

            {{-- ENCABEZADO --}}
            <div class="card-header" style="background-color: #0A9A9E; color: white; border-radius: 15px 15px 0 0;">
                <strong>Usuarios</strong>
            </div>
            {{-- CONTENIDO --}}
            <div class="card-body">
                <p class="mb-3" style="font-size: 15px; color: #555;">
                    Aquí puedes visualizar los usuarios registrados.
                </p>
                <div class="container">
                    <div class="row">
                        <table class="table" style="border-radius: 10px; overflow: hidden;">
                            <thead style="background-color: #e8f6f6; color: #0A9A9E;">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Fecha de creación</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                @endsection