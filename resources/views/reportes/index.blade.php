@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-file-earmark-bar-graph"></i> Reportes</h2>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Proyecto</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Reporte</th>
                </tr>
            </thead>
            <tbody>
                @forelse($presupuestos as $presupuesto)
                <tr>
                    <td>{{ $presupuesto->id_presupuesto }}</td>
                    <td>{{ $presupuesto->nombre_proyecto ?? '—' }}</td>
                    <td>{{ $presupuesto->nombre_cliente ?? '—' }}</td>
                    <td>{{ \Carbon\Carbon::parse($presupuesto->fecha)->format('d/m/Y') }}</td>
                    <td><strong>${{ number_format($presupuesto->total, 2) }}</strong></td>
                    <td>
                        <a href="{{ route('reportes.presupuesto', $presupuesto->id_presupuesto) }}" class="btn btn-sm btn-dark" target="_blank">
                            <i class="bi bi-printer"></i> Ver Reporte
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No hay presupuestos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection