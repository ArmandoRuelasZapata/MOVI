<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sitio web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    @yield("content")




    <footer style="background-color: #087D83;">
        <div class="container">
            <div class="row">
                <!-- Columna 1: Logo -->
                <div class="col-lg-3 col-md-6 col-sm p-4 text-center">
                    <img src="{{ asset('images/logoMOVI.png') }}" alt="Logo MOVI" width="150" height="150">
                </div>

                <!-- Columna 2: Descripción -->
                <div class="col-lg-3 col-md-6 col-sm p-4">
                    <p>
                        Nuestra misión es mejorar la seguridad y eficiencia vial proporcionando
                        información actualizada sobre el estado de las vías. Facilitamos a la ciudadanía
                        el acceso a datos relevantes y la posibilidad de reportar incidencias
                        en tiempo real, contribuyendo así a una mejor toma de decisiones
                        por parte de las autoridades.
                    </p>
                </div>

                <!-- Columna 3: Enlaces -->
                <div class="col-lg-3 col-md-6 col-sm p-4">
                    <ol type="I">
                        <li>Inicio</li>
                        <li>Acerca</li>
                        <li>Servicios</li>
                        <li>Contacto</li>
                    </ol>
                </div>

                <!-- Columna 4: Redes sociales -->
                <div class="col-lg-3 col-md-6 col-sm p-4">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <img src="{{ asset('images/facebook.png') }}" alt="Facebook Icon"
                                style="width: 24px; height: 24px; margin-right: 8px; vertical-align: middle;">
                            Facebook
                        </li>
                        <li class="mb-2">
                            <img src="{{ asset('images/instagram.png') }}" alt="Instagram Icon"
                                style="width: 24px; height: 24px; margin-right: 8px; vertical-align: middle;">
                            Instagram
                        </li>
                        <li class="mb-2">
                            <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp Icon"
                                style="width: 24px; height: 24px; margin-right: 8px; vertical-align: middle;">
                            WhatsApp
                        </li>
                        <li class="mb-2">
                            <img src="{{ asset('images/linkedin.png') }}" alt="LinkedIn Icon"
                                style="width: 24px; height: 24px; margin-right: 8px; vertical-align: middle;">
                            LinkedIn
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>