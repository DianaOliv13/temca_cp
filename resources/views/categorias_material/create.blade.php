@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Nueva Categoría</h2>

    @if ($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('categorias-material.store') }}"
          method="POST">

        @csrf

        <div class="mb-3">

            <label>Nombre</label>

            <input type="text"
                   name="nombre"
                   class="form-control"
                   required>

        </div>

        <div class="mb-3">

            <label>Descripción</label>

            <textarea name="descripcion"
                      class="form-control"
                      rows="3"></textarea>

        </div>

        <button class="btn btn-primary">

            Guardar

        </button>

        <a href="{{ route('categorias-material.index') }}"
           class="btn btn-secondary">

            Cancelar

        </a>

    </form>

</div>
@endsection