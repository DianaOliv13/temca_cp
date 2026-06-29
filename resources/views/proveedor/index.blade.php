@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h2>Proveedores</h2>

        <a href="{{ route('proveedores.create') }}" class="btn btn-primary">
            Nuevo proveedor
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>RFC</th>
                <th width="220">Acciones</th>
            </tr>
        </thead>

        <tbody>

        @forelse($proveedores as $proveedor)

            <tr>
                <td>{{ $proveedor->id_proveedor }}</td>
                <td>{{ $proveedor->nombre }}</td>
                <td>{{ $proveedor->telefono }}</td>
                <td>{{ $proveedor->correo }}</td>
                <td>{{ $proveedor->rfc }}</td>

                <td>

                    <a href="{{ route('proveedores.edit', $proveedor) }}"
                       class="btn btn-warning btn-sm">
                        Editar
                    </a>

                    <form action="{{ route('proveedores.destroy', $proveedor) }}"
                          method="POST"
                          class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Eliminar proveedor?')">
                            Eliminar
                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="6" class="text-center">
                    No existen proveedores registrados.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>
@endsection