@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-folder"></i> Proyectos</h2>
    <a href="{{ route('proyectos.create') }}" class="btn btn-dark">
        <i class="bi bi-plus-circle"></i> Nuevo Proyecto
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Cliente</th>
                    <th>Ubicación</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto->id_proyecto }}</td>
                    <td>{{ $proyecto->nombre }}</td>
                    <td>{{ $proyecto->cliente->nombre ?? '—' }}</td>
                    <td>{{ $proyecto->ubicacion }}</td>
                    <td>{{ $proyecto->fecha_inicio }}</td>
                    <td>{{ $proyecto->fecha_fin }}</td>
                    <td>
                        <a href="{{ route('proyectos.edit', $proyecto->id_proyecto) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('proyectos.destroy', $proyecto->id_proyecto) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar proyecto?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No hay proyectos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection