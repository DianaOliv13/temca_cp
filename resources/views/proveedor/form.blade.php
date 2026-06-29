<div class="row">

    <div class="col-md-6 mb-3">
        <label class="form-label">Nombre del Cliente</label>
        <input type="text" name="nombre_cliente" class="form-control"
            value="{{ old('nombre_cliente', $presupuesto->nombre_cliente ?? '') }}" required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Empresa</label>
        <input type="text" name="empresa_cliente" class="form-control"
            value="{{ old('empresa_cliente', $presupuesto->empresa_cliente ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Ubicación</label>
        <input type="text" name="ubicacion" class="form-control"
            value="{{ old('ubicacion', $presupuesto->ubicacion ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Nombre del Proyecto</label>
        <input type="text" name="nombre_proyecto" class="form-control"
            value="{{ old('nombre_proyecto', $presupuesto->nombre_proyecto ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Fecha</label>
        <input type="date" name="fecha" class="form-control"
            value="{{ old('fecha', $presupuesto->fecha ?? date('Y-m-d')) }}" required>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Subtotal</label>
        <input type="number" step="0.01" name="subtotal" class="form-control"
            value="{{ old('subtotal', $presupuesto->subtotal ?? 0) }}">
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">IVA</label>
        <input type="number" step="0.01" name="iva" class="form-control"
            value="{{ old('iva', $presupuesto->iva ?? 0) }}">
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Total</label>
        <input type="number" step="0.01" name="total" class="form-control"
            value="{{ old('total', $presupuesto->total ?? 0) }}">
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Vigencia (días)</label>
        <input type="number" name="vigencia_dias" class="form-control"
            value="{{ old('vigencia_dias', $presupuesto->vigencia_dias ?? 10) }}">
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Anticipo (%)</label>
        <input type="number" step="0.01" name="anticipo_porcentaje" class="form-control"
            value="{{ old('anticipo_porcentaje', $presupuesto->anticipo_porcentaje ?? 50) }}">
    </div>

    <div class="col-12 mb-3">
        <label class="form-label">Observaciones</label>
        <textarea name="observaciones" class="form-control" rows="4">{{ old('observaciones', $presupuesto->observaciones ?? '') }}</textarea>
    </div>

</div>