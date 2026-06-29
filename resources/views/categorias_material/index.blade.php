@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Categorías de Materiales</h2>

        <a href="{{ route('categorias-material.create') }}"
           class="btn btn-primary">

            Nueva Categoría

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

                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th width="180">Acciones</th>

            </tr>

        </thead>

        <tbody>

        @forelse($categorias as $categoria)

            <tr>

                <td>{{ $categoria->id_categoria }}</td>

                <td>{{ $categoria->nombre }}</td>

                <td>{{ $categoria->descripcion }}</td>

                <td>

                    <a href="{{ route('categorias-material.edit', $categoria->id_categoria) }}"
                       class="btn btn-warning btn-sm">

                        Editar

                    </a>

                    <form action="{{ route('categorias-material.destroy', $categoria->id_categoria) }}"
                          method="POST"
                          class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Eliminar categoría?')">

                            Eliminar

                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="4" class="text-center">

                    No existen categorías registradas.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>
@endsection