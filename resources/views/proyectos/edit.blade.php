@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-pencil-square"></i> Editar Proyecto</h2>
    <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Regresar
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('proyectos.update', $proyecto->id_proyecto) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Cliente <span class="text-danger">*</span></label>
                <select name="id_cliente" class="form-select" required>
                    <option value="">— Selecciona un cliente —</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id_cliente }}" {{ $proyecto->id_cliente == $cliente->id_cliente ? 'selected' : '' }}>
                            {{ $cliente->nombre }} — {{ $cliente->empresa }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Nombre del Proyecto <span class="text-danger">*</span></label>
                <input type="text" name="nombre" class="form-control" value="{{ $proyecto->nombre }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Ubicación</label>
                <input type="text" name="ubicacion" class="form-control" value="{{ $proyecto->ubicacion }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3">{{ $proyecto->descripcion }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control" value="{{ $proyecto->fecha_inicio }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Fecha Fin</label>
                    <input type="date" name="fecha_fin" class="form-control" value="{{ $proyecto->fecha_fin }}">
                </div>
            </div>
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save"></i> Actualizar
            </button>
        </form>
    </div>
</div>
@endsection