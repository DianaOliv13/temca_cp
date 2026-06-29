@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-folder-plus"></i> Nuevo Proyecto</h2>
    <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Regresar
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('proyectos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Cliente <span class="text-danger">*</span></label>
                <select name="id_cliente" class="form-select" required>
                    <option value="">— Selecciona un cliente —</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }} — {{ $cliente->empresa }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Nombre del Proyecto <span class="text-danger">*</span></label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Ubicación</label>
                <input type="text" name="ubicacion" class="form-control" value="{{ old('ubicacion') }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Fecha Fin</label>
                    <input type="date" name="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save"></i> Guardar
            </button>
        </form>
    </div>
</div>
@endsection