@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Materiales</h2>

        <a href="{{ route('materiales.create') }}" class="btn btn-success">
            Nuevo material
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered table-hover">

        <thead class="table-dark">
            <tr>
                <th>Proveedor</th>
                <th>Material</th>
                <th>Unidad</th>
                <th>Precio Unitario</th>
                <th>Fecha</th>
                <th width="170">Acciones</th>
            </tr>
        </thead>

        <tbody>

        @forelse($materiales as $material)

        <tr>

            <td>{{ $material->proveedor->nombre ?? 'Sin proveedor' }}</td>

            <td>{{ $material->nombre }}</td>

            <td>{{ $material->unidad }}</td>

            <td>$ {{ number_format($material->precio_unitario,2) }}</td>

            <td>{{ $material->fecha_actualizacion }}</td>

            <td>

                <a href="{{ route('materiales.edit',$material->id_material) }}"
                    class="btn btn-warning btn-sm">

                    Editar

                </a>

                <form
                    action="{{ route('materiales.destroy',$material->id_material) }}"
                    method="POST"
                    class="d-inline">

                    @csrf
                    @method('DELETE')

                    <button
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('¿Eliminar material?')">

                        Eliminar

                    </button>

                </form>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="6" class="text-center">

                No existen materiales registrados.

            </td>

        </tr>

        @endforelse

        </tbody>

    </table>

</div>
@endsection