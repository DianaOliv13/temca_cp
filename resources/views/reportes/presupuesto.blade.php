<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presupuesto — {{ $presupuesto->nombre_proyecto }}</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 13px;
            color: #212529;
            margin: 0;
            padding: 30px;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            margin-right: 8px;
        }
        .btn-dark { background-color: #212529; color: #fff; }
        .btn-secondary { background-color: #6c757d; color: #fff; }
        .header-empresa {
            border-bottom: 3px solid #212529;
            padding-bottom: 15px;
            margin-bottom: 20px;
            display: table;
            width: 100%;
        }
        .header-empresa .col-izq { display: table-cell; width: 65%; vertical-align: top; }
        .header-empresa .col-der { display: table-cell; width: 35%; vertical-align: top; text-align: right; }
        .datos-proyecto {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .datos-proyecto .col { display: table-cell; width: 50%; vertical-align: top; }
        .datos-proyecto table { width: 100%; }
        .datos-proyecto td { padding: 3px 0; }
        .tabla-materiales {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .tabla-materiales th {
            background-color: #212529;
            color: #fff;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        .tabla-materiales td {
            padding: 8px;
            border-bottom: 1px solid #dee2e6;
            font-size: 12px;
        }
        .text-center { text-align: center; }
        .text-end { text-align: right; }
        .text-muted { color: #6c757d; }
        .totales-wrapper { display: table; width: 100%; }
        .totales-box {
            display: table-cell;
            width: 35%;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
        }
        .totales-fila {
            display: table;
            width: 100%;
            margin-bottom: 6px;
        }
        .totales-fila .izq { display: table-cell; text-align: left; }
        .totales-fila .der { display: table-cell; text-align: right; }
        .totales-fila.total { font-size: 15px; font-weight: bold; border-top: 1px solid #dee2e6; padding-top: 8px; }
        .notas { font-size: 11px; color: #6c757d; }
        .detalle-rendimiento { font-size: 10px; color: #6c757d; }
        .badge-id { font-size: 11px; color: #6c757d; }
    </style>
</head>
<body>

    <!-- Botones de acción (solo visibles en pantalla, nunca en el PDF) -->
    @if(!($paraPdf ?? false))
    <div style="margin-bottom: 16px;">
        <a href="{{ route('reportes.presupuesto.pdf', $presupuesto->id_presupuesto) }}" class="btn btn-dark">
            ⬇ Descargar PDF
        </a>
        <a href="{{ route('reportes.index') }}" class="btn btn-secondary">
            ← Regresar
        </a>
    </div>
    @endif

    <!-- Encabezado -->
    <div class="header-empresa">
        <div class="col-izq">
            <h4 style="margin: 0 0 4px 0;">QUALITYTIME Diseño y Construcción S.A. de C.V.</h4>
            <p style="margin: 0; color: #6c757d;">TEMCA — Área de Costos y Presupuestos</p>
        </div>
        <div class="col-der">
            <h5 style="margin: 0 0 4px 0;">PRESUPUESTO</h5>
            <p style="margin: 0;">No. {{ str_pad($presupuesto->id_presupuesto, 4, '0', STR_PAD_LEFT) }}</p>
            <p style="margin: 0;">Fecha: {{ \Carbon\Carbon::parse($presupuesto->fecha)->format('d/m/Y') }}</p>
        </div>
    </div>

    <!-- Datos del proyecto -->
    <div class="datos-proyecto">
        <div class="col">
            <table>
                <tr>
                    <td style="font-weight: bold; width: 90px;">Empresa:</td>
                    <td>{{ $presupuesto->empresa_cliente ?? '—' }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Cliente:</td>
                    <td>{{ $presupuesto->nombre_cliente ?? '—' }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Proyecto:</td>
                    <td>{{ $presupuesto->nombre_proyecto }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Ubicación:</td>
                    <td>{{ $presupuesto->ubicacion ?? '—' }}</td>
                </tr>
            </table>
        </div>
        <div class="col">
            <table>
                <tr>
                    <td style="font-weight: bold; width: 90px;">Vigencia:</td>
                    <td>{{ $presupuesto->vigencia_dias }} días a partir de la fecha</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Anticipo:</td>
                    <td>{{ $presupuesto->anticipo_porcentaje }}% para iniciar trabajos</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Tabla de materiales -->
    <table class="tabla-materiales">
        <thead>
            <tr>
                <th>Material</th>
                <th class="text-center">Unidad</th>
                <th class="text-center">Cantidad</th>
                <th class="text-end">P.U.</th>
                <th class="text-end">Importe</th>
            </tr>
        </thead>
        <tbody>
            @forelse($presupuesto->detalles as $detalle)
            <tr>
                <td>
                    {{ $detalle->material->nombre ?? '—' }}

                    @if($detalle->modo_calculo === 'rendimiento' && $detalle->area_o_volumen && $detalle->rendimiento)
                        <br>
                        <span class="detalle-rendimiento">
                            Cubre {{ $detalle->area_o_volumen }} {{ $detalle->material->unidad_rendimiento ?? '' }}
                            (rinde {{ $detalle->rendimiento }} {{ $detalle->material->unidad_rendimiento ?? '' }} por {{ $detalle->material->unidad ?? 'unidad' }})
                        </span>
                    @endif
                </td>
                <td class="text-center">{{ $detalle->material->unidad ?? '—' }}</td>
                <td class="text-center">{{ $detalle->cantidad }}</td>
                <td class="text-end">${{ number_format($detalle->precio_unitario, 2) }}</td>
                <td class="text-end">${{ number_format($detalle->importe, 2) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Sin materiales registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Totales -->
    <div class="totales-wrapper" style="margin-bottom: 20px;">
        <div></div>
        <div class="totales-box">
            <div class="totales-fila">
                <span class="izq">Subtotal:</span>
                <strong class="der">${{ number_format($presupuesto->subtotal, 2) }}</strong>
            </div>
            <div class="totales-fila">
                <span class="izq">I.V.A. (16%):</span>
                <strong class="der">${{ number_format($presupuesto->iva, 2) }}</strong>
            </div>
            <div class="totales-fila total">
                <span class="izq">TOTAL:</span>
                <strong class="der">${{ number_format($presupuesto->total, 2) }}</strong>
            </div>
        </div>
    </div>

    <!-- Observaciones -->
    @if($presupuesto->observaciones)
    <div style="margin-bottom: 20px;">
        <p style="font-weight: bold; margin: 0 0 4px 0;">Observaciones:</p>
        <div class="notas">{{ $presupuesto->observaciones }}</div>
    </div>
    @endif

</body>
</html>