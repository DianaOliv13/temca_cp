@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Editar Material</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('materiales.update', $material->id_material) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>Proveedor</label>

            <select
                name="id_proveedor"
                class="form-control"
                required>

                @foreach($proveedores as $proveedor)

                    <option
                        value="{{ $proveedor->id_proveedor }}"
                        {{ $material->id_proveedor == $proveedor->id_proveedor ? 'selected' : '' }}>

                        {{ $proveedor->nombre }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label>Categoría</label>

            <select
                name="id_categoria"
                class="form-control"
                required>

                @foreach($categorias as $categoria)

                    <option
                        value="{{ $categoria->id_categoria }}"
                        {{ $material->id_categoria == $categoria->id_categoria ? 'selected' : '' }}>

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
                value="{{ old('nombre', $material->nombre) }}"
                required>

        </div>

        <div class="mb-3">

            <label>Descripción</label>

            <textarea
                name="descripcion"
                class="form-control"
                rows="3">{{ old('descripcion', $material->descripcion) }}</textarea>

        </div>

        <div class="mb-3">

            <label>Unidad</label>

            <input
                type="text"
                name="unidad"
                class="form-control"
                value="{{ old('unidad', $material->unidad) }}"
                placeholder="Ej. bulto, kg, pieza">

        </div>

        <div class="mb-3">

            <label>Unidad de rendimiento</label>

            <input
                type="text"
                name="unidad_rendimiento"
                class="form-control"
                value="{{ old('unidad_rendimiento', $material->unidad_rendimiento) }}"
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
                value="{{ old('precio_unitario', $material->precio_unitario) }}"
                required>

        </div>

        <div class="mb-3">

            <label>Fecha actualización</label>

            <input
                type="date"
                name="fecha_actualizacion"
                class="form-control"
                value="{{ old('fecha_actualizacion', $material->fecha_actualizacion) }}"
                required>

        </div>

        <button class="btn btn-primary">
            Actualizar
        </button>

        <a href="{{ route('materiales.index') }}" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>
@endsection