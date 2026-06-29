@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Nuevo Proveedor</h2>

    <form action="{{ route('proveedores.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input
                type="text"
                name="nombre"
                class="form-control"
                value="{{ old('nombre') }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input
                type="text"
                name="telefono"
                class="form-control"
                value="{{ old('telefono') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Correo</label>
            <input
                type="email"
                name="correo"
                class="form-control"
                value="{{ old('correo') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">RFC</label>
            <input
                type="text"
                name="rfc"
                class="form-control"
                value="{{ old('rfc') }}">
        </div>

        <button type="submit" class="btn btn-success">
            Guardar
        </button>

        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

@endsection