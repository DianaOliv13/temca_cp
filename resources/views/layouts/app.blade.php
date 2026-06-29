<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEMCA — Costos y Presupuestos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        #loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,.4);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        #loading-overlay.active {
            display: flex;
        }
    </style>
</head>

<body class="bg-light">

<div id="loading-overlay">
    <div class="text-center text-white">
        <div class="spinner-border mb-2" style="width:3rem;height:3rem;"></div>
        <div class="fw-bold fs-5">Procesando...</div>
    </div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('materiales.index') }}">
            <i class="bi bi-building"></i> TEMCA
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('presupuestos.*') ? 'active' : '' }}"
                       href="{{ route('presupuestos.index') }}">
                        <i class="bi bi-receipt"></i> Presupuestos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('materiales.*') ? 'active' : '' }}"
                       href="{{ route('materiales.index') }}">
                        <i class="bi bi-box"></i> Materiales
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('categorias-material.*') ? 'active' : '' }}"
                       href="{{ route('categorias-material.index') }}">
                        <i class="bi bi-tags"></i> Categorías
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('proveedores.*') ? 'active' : '' }}"
                       href="{{ route('proveedores.index') }}">
                        <i class="bi bi-truck"></i> Proveedores
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('reportes.*') ? 'active' : '' }}"
                       href="{{ route('reportes.index') }}">
                        <i class="bi bi-file-earmark-bar-graph"></i> Reportes
                    </a>
                </li>

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf

                        <button type="submit"
                                class="btn nav-link text-white border-0">
                            <i class="bi bi-box-arrow-right"></i> Salir
                        </button>
                    </form>
                </li>

            </ul>

        </div>
    </div>
</nav>

<!-- Contenido -->
<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle"></i>
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>

    setTimeout(function () {

        document.querySelectorAll('.alert').forEach(function(alert){

            let bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
            bsAlert.close();

        });

    }, 3000);


    document.querySelectorAll('form').forEach(function(form){

        form.addEventListener('submit', function(){

            document.getElementById('loading-overlay')
                .classList.add('active');

        });

    });

</script>

</body>
</html>