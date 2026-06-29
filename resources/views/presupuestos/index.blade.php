@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-receipt"></i> Presupuestos</h2>
    <a href="{{ route('presupuestos.create') }}" class="btn btn-dark">
        <i class="bi bi-plus-circle"></i> Nuevo Presupuesto
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Proyecto</th>
                    <th>Fecha</th>
                    <th>Subtotal</th>
                    <th>IVA</th>
                    <th>Total</th>
                    <th>Vigencia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($presupuestos as $presupuesto)
                <tr>
                    <td>{{ $presupuesto->id_presupuesto }}</td>
                    <td>{{ $presupuesto->nombre_proyecto }}</td>
                    <td>{{ $presupuesto->fecha }}</td>
                    <td>${{ number_format($presupuesto->subtotal, 2) }}</td>
                    <td>${{ number_format($presupuesto->iva, 2) }}</td>
                    <td><strong>${{ number_format($presupuesto->total, 2) }}</strong></td>
                    <td>{{ $presupuesto->vigencia_dias }} días</td>
                    <td>
                        <a href="{{ route('presupuestos.edit', $presupuesto->id_presupuesto) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('presupuestos.destroy', $presupuesto->id_presupuesto) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar presupuesto?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No hay presupuestos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection