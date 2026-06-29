@extends('layouts.app')

@section('content')

<div class="mb-4">
    <h2 class="mb-1">
        ¡Hola{{ $nombreUsuario ? ', ' . $nombreUsuario : '' }}! 👋
    </h2>
    <p class="text-muted mb-0">
        {{ $fechaHoy }}
    </p>
</div>

<div class="row g-3">

    <div class="col-md-6 col-lg-3">
        <a href="{{ route('presupuestos.create') }}" class="text-decoration-none">
            <div class="card shadow-sm h-100 text-center py-4">
                <div class="card-body">
                    <div class="fs-1 mb-2">📋</div>
                    <h5 class="mb-0">Nuevo Presupuesto</h5>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-3">
        <a href="{{ route('presupuestos.index') }}" class="text-decoration-none">
            <div class="card shadow-sm h-100 text-center py-4">
                <div class="card-body">
                    <div class="fs-1 mb-2">📂</div>
                    <h5 class="mb-0">Ver Presupuestos</h5>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-3">
        <a href="{{ route('materiales.index') }}" class="text-decoration-none">
            <div class="card shadow-sm h-100 text-center py-4">
                <div class="card-body">
                    <div class="fs-1 mb-2">📦</div>
                    <h5 class="mb-0">Materiales</h5>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-3">
        <a href="{{ route('reportes.index') }}" class="text-decoration-none">
            <div class="card shadow-sm h-100 text-center py-4">
                <div class="card-body">
                    <div class="fs-1 mb-2">📊</div>
                    <h5 class="mb-0">Reportes</h5>
                </div>
            </div>
        </a>
    </div>

</div>

<style>
    .card a, a.text-decoration-none .card {
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    a.text-decoration-none:hover .card {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1) !important;
    }
</style>

@endsection