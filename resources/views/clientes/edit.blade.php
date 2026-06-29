@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-pencil-square"></i> Editar Cliente</h2>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Regresar
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('clientes.update', $cliente->id_cliente) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Nombre <span class="text-danger">*</span></label>
                <input type="text" name="nombre" class="form-control" value="{{ $cliente->nombre }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Empresa</label>
                <input type="text" name="empresa" class="form-control" value="{{ $cliente->empresa }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="{{ $cliente->telefono }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Correo</label>
                <input type="email" name="correo" class="form-control" value="{{ $cliente->correo }}">
            </div>
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save"></i> Actualizar
            </button>
        </form>
    </div>
</div>
@endsection