@extends('layouts.app')

@section('content')

<div class="container">

<h2>Editar Presupuesto</h2>

<form action="{{ route('presupuestos.update',$presupuesto) }}" method="POST">

@csrf
@method('PUT')

@include('presupuestos.form')

<button class="btn btn-primary">

Actualizar

</button>

<a href="{{ route('presupuestos.index') }}" class="btn btn-secondary">

Cancelar

</a>

</form>

</div>

@endsection