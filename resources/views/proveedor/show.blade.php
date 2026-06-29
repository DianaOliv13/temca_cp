@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Detalle del Presupuesto</h2>

    <table class="table table-bordered">

        <tr>
            <th>Cliente</th>
            <td>{{ $presupuesto->nombre_cliente }}</td>
        </tr>

        <tr>
            <th>Empresa</th>
            <td>{{ $presupuesto->empresa_cliente }}</td>
        </tr>

        <tr>
            <th>Ubicación</th>
            <td>{{ $presupuesto->ubicacion }}</td>
        </tr>

        <tr>
            <th>Proyecto</th>
            <td>{{ $presupuesto->nombre_proyecto }}</td>
        </tr>

        <tr>
            <th>Fecha</th>
            <td>{{ $presupuesto->fecha }}</td>
        </tr>

        <tr>
            <th>Subtotal</th>
            <td>${{ number_format($presupuesto->subtotal,2) }}</td>
        </tr>

        <tr>
            <th>IVA</th>
            <td>${{ number_format($presupuesto->iva,2) }}</td>
        </tr>

        <tr>
            <th>Total</th>
            <td>${{ number_format($presupuesto->total,2) }}</td>
        </tr>

        <tr>
            <th>Vigencia</th>
            <td>{{ $presupuesto->vigencia_dias }} días</td>
        </tr>

        <tr>
            <th>Anticipo</th>
            <td>{{ $presupuesto->anticipo_porcentaje }}%</td>
        </tr>

        <tr>
            <th>Observaciones</th>
            <td>{{ $presupuesto->observaciones }}</td>
        </tr>

    </table>

    <a href="{{ route('presupuestos.index') }}" class="btn btn-secondary">
        Regresar
    </a>

</div>

@endsection