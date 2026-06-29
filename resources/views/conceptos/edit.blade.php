@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-pencil-square"></i> Editar Concepto</h2>
    <a href="{{ route('conceptos.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Regresar
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('conceptos.update', $concepto->id_concepto) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label fw-bold">Código</label>
                    <input type="text" name="codigo" class="form-control" value="{{ $concepto->codigo }}">
                </div>
                <div class="col-md-9 mb-3">
                    <label class="form-label fw-bold">Descripción <span class="text-danger">*</span></label>
                    <textarea name="descripcion" class="form-control" rows="3" required>{{ $concepto->descripcion }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Unidad</label>
                    <select name="unidad" class="form-select">
                        <option value="">— Selecciona —</option>
                        @foreach(['M2','ML','PZA','KG','LT','LOTE','TON'] as $u)
                            <option value="{{ $u }}" {{ $concepto->unidad == $u ? 'selected' : '' }}>{{ $u }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Precio Unitario</label>
                    <input type="number" step="0.01" name="precio_unitario" class="form-control" value="{{ $concepto->precio_unitario }}">
                </div>
            </div>
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save"></i> Actualizar
            </button>
        </form>
    </div>
</div>
@endsection