@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Nuevo Material</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('materiales.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label>Proveedor</label>

            <select name="id_proveedor" class="form-control" required>

                <option value="">Seleccione...</option>

                @foreach($proveedores as $proveedor)

                    <option value="{{ $proveedor->id_proveedor }}">
                        {{ $proveedor->nombre }}
                    </option>

                @endforeach

            </select>
        </div>

        <div class="mb-3">
            <label>Categoría</label>

            <select name="id_categoria" class="form-control" required>

                <option value="">Seleccione...</option>

                @foreach($categorias as $categoria)

                    <option value="{{ $categoria->id_categoria }}">
                        {{ $categoria->nombre }}
                    </option>

                @endforeach

            </select>
        </div>

        <div class="mb-3">

            <label>Nombre</label>

            <input
                type="text"
                name="nombre"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>Descripción</label>

            <textarea
                name="descripcion"
                class="form-control"
                rows="3"></textarea>

        </div>

        <div class="mb-3">

            <label>Unidad</label>

            <input
                type="text"
                name="unidad"
                class="form-control"
                placeholder="Ej. bulto, kg, pieza">

        </div>

        <div class="mb-3">

            <label>Unidad de rendimiento</label>

            <input
                type="text"
                name="unidad_rendimiento"
                class="form-control"
                placeholder="Ej. m², m³, ml">

            <small class="form-text text-muted">
                Unidad en la que se mide lo que cubre este material (ej. cuántos m² cubre).
                Déjalo en blanco si no aplica el concepto de rendimiento para este material.
            </small>

        </div>

        <div class="mb-3">

            <label>Precio Unitario</label>

            <input
                type="number"
                step="0.01"
                min="0"
                name="precio_unitario"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>Fecha actualización</label>

            <input
                type="date"
                name="fecha_actualizacion"
                class="form-control"
                value="{{ date('Y-m-d') }}"
                required>

        </div>

        <button class="btn btn-primary">
            Guardar
        </button>

        <a href="{{ route('materiales.index') }}" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>
@endsection