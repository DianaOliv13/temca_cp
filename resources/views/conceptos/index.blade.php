@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-list-check"></i> Conceptos</h2>
    <a href="{{ route('conceptos.create') }}" class="btn btn-dark">
        <i class="bi bi-plus-circle"></i> Nuevo Concepto
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Unidad</th>
                    <th>Precio Unitario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($conceptos as $concepto)
                <tr>
                    <td>{{ $concepto->id_concepto }}</td>
                    <td><span class="badge bg-dark">{{ $concepto->codigo }}</span></td>
                    <td>{{ Str::limit($concepto->descripcion, 60) }}</td>
                    <td>{{ $concepto->unidad }}</td>
                    <td>${{ number_format($concepto->precio_unitario, 2) }}</td>
                    <td>
                        <a href="{{ route('conceptos.edit', $concepto->id_concepto) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('conceptos.destroy', $concepto->id_concepto) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar concepto?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No hay conceptos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection