@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people"></i> Clientes</h2>
    <a href="{{ route('clientes.create') }}" class="btn btn-dark">
        <i class="bi bi-plus-circle"></i> Nuevo Cliente
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Empresa</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id_cliente }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->empresa }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->correo }}</td>
                    <td>
                        <a href="{{ route('clientes.edit', $cliente->id_cliente) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('clientes.destroy', $cliente->id_cliente) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar cliente?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No hay clientes registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection