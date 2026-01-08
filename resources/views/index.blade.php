@extends("layouts.master")
@section("content")

<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="3000">
            <img src="{{ asset('images/carrucel_1.png') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item active" data-bs-interval="3000">
            <img src="{{ asset('images/carrucel_2.png') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item active" data-bs-interval="3000">
            <img src="{{ asset('images/carrucel_3.png') }}" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="contenedorMaestro" style="background-color: #087D83;">
    <div class="container" style="background-color: #ffffff;">
        <div class="row mt-4">
            <h2 class="text-center mb-4">Servicios</h2>
            <div class="col-lg-4 col-md-6 col-sm">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('images/mps.jpeg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Mapas dinamicos</h5>
                        <p class="card-text">Con el mapa dinamico se podra ver como los reportes se ven en tiempo y forma ya echos por los usuarios.</p>
                        <a href="#" class="btn btn-primary">Ver caracteristicas</a>
                    </div>
                </div>
            </div>
             <div class="col-lg-4 col-md-6 col-sm">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('images/reporte2.jpeg')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Reportes personalizados</h5>
                        <p class="card-text">Los usuarios podrian mandar reportes por el lugar que esten y como podrian modificarlos como se les ocurra informar a los otros usuarios y a los oficiales de trancito.</p>
                        <a href="#" class="btn btn-primary">Ver caracteristicas</a>
                    </div>
                </div>
            </div>
             <div class="col-lg-4 col-md-6 col-sm">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('images/movilidad.jpeg')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Informacion de movilidad</h5>
                        <p class="card-text">La aplicacion tendra informacion en tiempo real gracias al mapa dinamico y alos oficiales de transito que esten monitoriando los reportes de los usuarios.</p>
                        <a href="#" class="btn btn-primary">Ver caracteristicas</a>
                    </div>
                </div>
            </div>
        </div>
</div>
<div>
@endsection