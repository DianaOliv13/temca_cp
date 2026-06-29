@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>
        <i class="bi bi-receipt"></i>
        Nuevo Presupuesto
    </h2>

    <a href="{{ route('presupuestos.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i>
        Regresar
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('presupuestos.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">
                    Nombre del Cliente <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="nombre_cliente"
                    class="form-control"
                    value="{{ old('nombre_cliente') }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">
                    Empresa
                </label>

                <input
                    type="text"
                    name="empresa_cliente"
                    class="form-control"
                    value="{{ old('empresa_cliente') }}">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">
                    Ubicación
                </label>

                <input
                    type="text"
                    name="ubicacion"
                    class="form-control"
                    value="{{ old('ubicacion') }}">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">
                    Nombre del Proyecto <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="nombre_proyecto"
                    class="form-control"
                    value="{{ old('nombre_proyecto') }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">
                    Fecha <span class="text-danger">*</span>
                </label>

                <input
                    type="date"
                    name="fecha"
                    class="form-control"
                    value="{{ old('fecha') }}"
                    required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Vigencia (días)
                    </label>

                    <input
                        type="number"
                        name="vigencia_dias"
                        class="form-control"
                        value="{{ old('vigencia_dias', 10) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Anticipo (%)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="anticipo_porcentaje"
                        class="form-control"
                        value="{{ old('anticipo_porcentaje', 50) }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">
                    Observaciones
                </label>

                <textarea
                    name="observaciones"
                    class="form-control"
                    rows="3">{{ old('observaciones') }}</textarea>
            </div>

            <hr>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>
                    <i class="bi bi-box"></i>
                    Materiales
                </h5>

                <button
                    type="button"
                    id="agregar-material"
                    class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle"></i>
                    Agregar Material
                </button>
            </div>

            <div id="contenedor-materiales">

                <div class="card mb-3 fila-material" data-indice="0">
                    <div class="card-body">

                        <div class="row align-items-end">

                            <div class="col-md-5 mb-2">
                                <label class="form-label small fw-bold">Material</label>

                                <select
                                    name="materiales[0][id_material]"
                                    class="form-select select-material">

                                    <option value="">
                                        Seleccione un material
                                    </option>

                                    @foreach($materiales as $material)
                                        <option
                                            value="{{ $material->id_material }}"
                                            data-unidad="{{ $material->unidad }}"
                                            data-unidad-rendimiento="{{ $material->unidad_rendimiento }}">
                                            {{ $material->nombre }}
                                            - ${{ number_format($material->precio_unitario,2) }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-5 mb-2">
                                <label class="form-label small fw-bold">¿Cómo quieres indicar la cantidad?</label>

                                <div class="btn-group w-100" role="group">
                                    <input
                                        type="radio"
                                        class="btn-check radio-modo"
                                        name="materiales[0][modo_calculo]"
                                        id="modo-manual-0"
                                        value="manual"
                                        checked>
                                    <label class="btn btn-outline-secondary btn-sm" for="modo-manual-0">
                                        Ya sé cuánto necesito
                                    </label>

                                    <input
                                        type="radio"
                                        class="btn-check radio-modo"
                                        name="materiales[0][modo_calculo]"
                                        id="modo-rendimiento-0"
                                        value="rendimiento">
                                    <label class="btn btn-outline-secondary btn-sm" for="modo-rendimiento-0">
                                        Ayúdame a calcularlo
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-2 mb-2 text-center">
                                <button
                                    type="button"
                                    class="btn btn-danger eliminar-fila">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>

                        </div>

                        <div class="row bloque-manual">
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">
                                    ¿Cuántas <span class="texto-unidad">unidades</span> necesitas?
                                </label>

                                <input
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    class="form-control input-cantidad-manual">
                            </div>
                        </div>

                        <div class="row bloque-rendimiento d-none">
                            <div class="col-md-4 mb-2">
                                <label class="form-label small fw-bold">
                                    ¿Cuánto necesitas cubrir?
                                </label>

                                <input
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    name="materiales[0][area_o_volumen]"
                                    class="form-control input-area">

                                <small class="form-text text-muted texto-unidad-area">
                                    Indica el total en la unidad que corresponda (m², m³, ml, etc.)
                                </small>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label class="form-label small fw-bold">
                                    ¿Cuánto cubre <span class="texto-unidad-compra">1 unidad</span>?
                                </label>

                                <input
                                    type="number"
                                    min="0.01"
                                    step="0.01"
                                    name="materiales[0][rendimiento]"
                                    class="form-control input-rendimiento">

                                <small class="form-text text-muted texto-unidad-rendimiento-ayuda">
                                    Ej. si 1 bulto cubre 4 m², escribe 4
                                </small>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label class="form-label small fw-bold">
                                    Vas a necesitar
                                </label>

                                <div class="form-control bg-light fw-bold text-center resultado-calculado-texto">
                                    0 unidades
                                </div>

                                <input type="hidden" class="resultado-calculado" value="0">
                            </div>
                        </div>

                        <input type="hidden" name="materiales[0][cantidad]" class="input-cantidad-final">

                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save"></i>
                Guardar Presupuesto
            </button>

        </form>

    </div>
</div>

<script>

let indice = 1;

function inicializarFila(fila) {

    let selectMaterial   = fila.querySelector('.select-material');
    let radiosModo        = fila.querySelectorAll('.radio-modo');
    let bloqueManual       = fila.querySelector('.bloque-manual');
    let bloqueRendimiento  = fila.querySelector('.bloque-rendimiento');
    let textoUnidad         = fila.querySelector('.texto-unidad');
    let textoUnidadCompra     = fila.querySelector('.texto-unidad-compra');
    let textoUnidadRendAyuda   = fila.querySelector('.texto-unidad-rendimiento-ayuda');
    let inputArea               = fila.querySelector('.input-area');
    let inputRendimiento         = fila.querySelector('.input-rendimiento');
    let resultadoCalculado       = fila.querySelector('.resultado-calculado');
    let resultadoCalculadoTexto  = fila.querySelector('.resultado-calculado-texto');
    let inputCantidadFinal        = fila.querySelector('.input-cantidad-final');
    let inputCantidadManual        = fila.querySelector('.input-cantidad-manual');

    function actualizarUnidades() {
        let opcion = selectMaterial.options[selectMaterial.selectedIndex];
        let unidadCompra = (opcion && opcion.dataset.unidad) ? opcion.dataset.unidad : 'unidades';
        let unidadRendimiento = (opcion && opcion.dataset.unidadRendimiento) ? opcion.dataset.unidadRendimiento : null;

        textoUnidad.textContent = unidadCompra;
        textoUnidadCompra.textContent = '1 ' + unidadCompra;

        if (unidadRendimiento) {
            textoUnidadRendAyuda.textContent = 'Ej. si 1 ' + unidadCompra + ' cubre 4 ' + unidadRendimiento + ', escribe 4';
        } else {
            textoUnidadRendAyuda.textContent = 'Escribe cuánto cubre 1 ' + unidadCompra;
        }

        actualizarTextoResultado(unidadCompra);
    }

    function actualizarTextoResultado(unidadCompra) {
        let cantidad = parseFloat(resultadoCalculado.value) || 0;
        let unidad = unidadCompra || (selectMaterial.options[selectMaterial.selectedIndex]?.dataset.unidad) || 'unidades';
        resultadoCalculadoTexto.textContent = cantidad + ' ' + unidad;
    }

    function calcularRendimiento() {
        let area = parseFloat(inputArea.value) || 0;
        let rendimiento = parseFloat(inputRendimiento.value) || 0;

        let cantidad = (rendimiento > 0) ? (area / rendimiento) : 0;
        cantidad = Math.round(cantidad * 100) / 100;

        resultadoCalculado.value = cantidad;
        inputCantidadFinal.value = cantidad;

        let opcion = selectMaterial.options[selectMaterial.selectedIndex];
        let unidadCompra = (opcion && opcion.dataset.unidad) ? opcion.dataset.unidad : 'unidades';
        actualizarTextoResultado(unidadCompra);
    }

    function sincronizarManual() {
        inputCantidadFinal.value = inputCantidadManual.value || 0;
    }

    function cambiarModo() {
        let modoSeleccionado = fila.querySelector('.radio-modo:checked').value;

        if (modoSeleccionado === 'rendimiento') {
            bloqueManual.classList.add('d-none');
            bloqueRendimiento.classList.remove('d-none');
            inputArea.disabled = false;
            inputRendimiento.disabled = false;
            calcularRendimiento();
        } else {
            bloqueManual.classList.remove('d-none');
            bloqueRendimiento.classList.add('d-none');
            inputArea.disabled = true;
            inputRendimiento.disabled = true;
            sincronizarManual();
        }
    }

    selectMaterial.addEventListener('change', actualizarUnidades);
    radiosModo.forEach(r => r.addEventListener('change', cambiarModo));
    inputArea.addEventListener('input', calcularRendimiento);
    inputRendimiento.addEventListener('input', calcularRendimiento);
    inputCantidadManual.addEventListener('input', sincronizarManual);

    actualizarUnidades();
    cambiarModo();
}

document.querySelectorAll('.fila-material').forEach(inicializarFila);

document.getElementById('agregar-material')
.addEventListener('click', function(){

    let opcionesMateriales = `
        <option value="">Seleccione un material</option>
        @foreach($materiales as $material)
            <option
                value="{{ $material->id_material }}"
                data-unidad="{{ $material->unidad }}"
                data-unidad-rendimiento="{{ $material->unidad_rendimiento }}">
                {{ $material->nombre }}
                - ${{ number_format($material->precio_unitario,2) }}
            </option>
        @endforeach
    `;

    let fila = document.createElement('div');
    fila.className = 'card mb-3 fila-material';
    fila.dataset.indice = indice;

    fila.innerHTML = `
        <div class="card-body">

            <div class="row align-items-end">

                <div class="col-md-5 mb-2">
                    <label class="form-label small fw-bold">Material</label>

                    <select
                        name="materiales[${indice}][id_material]"
                        class="form-select select-material">
                        ${opcionesMateriales}
                    </select>
                </div>

                <div class="col-md-5 mb-2">
                    <label class="form-label small fw-bold">¿Cómo quieres indicar la cantidad?</label>

                    <div class="btn-group w-100" role="group">
                        <input
                            type="radio"
                            class="btn-check radio-modo"
                            name="materiales[${indice}][modo_calculo]"
                            id="modo-manual-${indice}"
                            value="manual"
                            checked>
                        <label class="btn btn-outline-secondary btn-sm" for="modo-manual-${indice}">
                            Ya sé cuánto necesito
                        </label>

                        <input
                            type="radio"
                            class="btn-check radio-modo"
                            name="materiales[${indice}][modo_calculo]"
                            id="modo-rendimiento-${indice}"
                            value="rendimiento">
                        <label class="btn btn-outline-secondary btn-sm" for="modo-rendimiento-${indice}">
                            Ayúdame a calcularlo
                        </label>
                    </div>
                </div>

                <div class="col-md-2 mb-2 text-center">
                    <button type="button" class="btn btn-danger eliminar-fila">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>

            </div>

            <div class="row bloque-manual">
                <div class="col-md-4">
                    <label class="form-label small fw-bold">
                        ¿Cuántas <span class="texto-unidad">unidades</span> necesitas?
                    </label>

                    <input
                        type="number"
                        min="0"
                        step="0.01"
                        class="form-control input-cantidad-manual">
                </div>
            </div>

            <div class="row bloque-rendimiento d-none">
                <div class="col-md-4 mb-2">
                    <label class="form-label small fw-bold">
                        ¿Cuánto necesitas cubrir?
                    </label>

                    <input
                        type="number"
                        min="0"
                        step="0.01"
                        name="materiales[${indice}][area_o_volumen]"
                        class="form-control input-area">

                    <small class="form-text text-muted texto-unidad-area">
                        Indica el total en la unidad que corresponda (m², m³, ml, etc.)
                    </small>
                </div>

                <div class="col-md-4 mb-2">
                    <label class="form-label small fw-bold">
                        ¿Cuánto cubre <span class="texto-unidad-compra">1 unidad</span>?
                    </label>

                    <input
                        type="number"
                        min="0.01"
                        step="0.01"
                        name="materiales[${indice}][rendimiento]"
                        class="form-control input-rendimiento">

                    <small class="form-text text-muted texto-unidad-rendimiento-ayuda">
                        Escribe cuánto cubre 1 unidad
                    </small>
                </div>

                <div class="col-md-4 mb-2">
                    <label class="form-label small fw-bold">
                        Vas a necesitar
                    </label>

                    <div class="form-control bg-light fw-bold text-center resultado-calculado-texto">
                        0 unidades
                    </div>

                    <input type="hidden" class="resultado-calculado" value="0">
                </div>
            </div>

            <input type="hidden" name="materiales[${indice}][cantidad]" class="input-cantidad-final">

        </div>
    `;

    document.getElementById('contenedor-materiales').appendChild(fila);

    inicializarFila(fila);

    indice++;
});

document.addEventListener('click', function(e){

    if(e.target.closest('.eliminar-fila')){
        e.target.closest('.fila-material').remove();
    }

});

</script>

@endsection