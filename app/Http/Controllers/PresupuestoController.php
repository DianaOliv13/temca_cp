<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use App\Models\DetallePresupuesto;
use App\Models\Material;
use Illuminate\Http\Request;

class PresupuestoController extends Controller
{
    public function index()
    {
        $presupuestos = Presupuesto::orderBy('id_presupuesto', 'desc')->get();

        return view('presupuestos.index', compact('presupuestos'));
    }

    public function create()
    {
        $materiales = Material::with('proveedor')->get();

        return view('presupuestos.create', compact('materiales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_cliente' => 'required|max:150',
            'nombre_proyecto' => 'required|max:150',
            'fecha' => 'required|date',
        ]);

        $lineas = $this->prepararLineasMateriales($request->materiales ?? []);

        $subtotal = array_sum(array_column($lineas, 'importe'));
        $iva = $subtotal * 0.16;
        $total = $subtotal + $iva;

        $presupuesto = Presupuesto::create([
            'nombre_cliente' => $request->nombre_cliente,
            'empresa_cliente' => $request->empresa_cliente,
            'ubicacion' => $request->ubicacion,
            'nombre_proyecto' => $request->nombre_proyecto,
            'fecha' => $request->fecha,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
            'vigencia_dias' => $request->vigencia_dias,
            'anticipo_porcentaje' => $request->anticipo_porcentaje,
            'observaciones' => $request->observaciones,
        ]);

        $this->guardarLineasMateriales($presupuesto->id_presupuesto, $lineas);

        return redirect()
            ->route('presupuestos.index')
            ->with('success', 'Presupuesto creado correctamente.');
    }

    public function show(Presupuesto $presupuesto)
    {
        $presupuesto->load('detalles.material.proveedor');

        return view('presupuestos.show', compact('presupuesto'));
    }

    public function edit(Presupuesto $presupuesto)
    {
        $materiales = Material::with('proveedor')->get();

        $presupuesto->load('detalles');

        return view('presupuestos.edit', compact(
            'presupuesto',
            'materiales'
        ));
    }

    public function update(Request $request, Presupuesto $presupuesto)
    {
        $request->validate([
            'nombre_cliente' => 'required|max:150',
            'nombre_proyecto' => 'required|max:150',
            'fecha' => 'required|date',
        ]);

        $lineas = $this->prepararLineasMateriales($request->materiales ?? []);

        $subtotal = array_sum(array_column($lineas, 'importe'));
        $iva = $subtotal * 0.16;
        $total = $subtotal + $iva;

        $presupuesto->update([
            'nombre_cliente' => $request->nombre_cliente,
            'empresa_cliente' => $request->empresa_cliente,
            'ubicacion' => $request->ubicacion,
            'nombre_proyecto' => $request->nombre_proyecto,
            'fecha' => $request->fecha,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
            'vigencia_dias' => $request->vigencia_dias,
            'anticipo_porcentaje' => $request->anticipo_porcentaje,
            'observaciones' => $request->observaciones,
        ]);

        DetallePresupuesto::where(
            'id_presupuesto',
            $presupuesto->id_presupuesto
        )->delete();

        $this->guardarLineasMateriales($presupuesto->id_presupuesto, $lineas);

        return redirect()
            ->route('presupuestos.index')
            ->with('success', 'Presupuesto actualizado correctamente.');
    }

    public function destroy(Presupuesto $presupuesto)
    {
        DetallePresupuesto::where(
            'id_presupuesto',
            $presupuesto->id_presupuesto
        )->delete();

        $presupuesto->delete();

        return redirect()
            ->route('presupuestos.index')
            ->with('success', 'Presupuesto eliminado correctamente.');
    }

    /**
     * Procesa el arreglo "materiales" recibido del formulario (modo manual
     * o por rendimiento) y devuelve un arreglo normalizado y listo para
     * guardar, con la cantidad e importe ya validados/recalculados.
     *
     * Por seguridad, si el modo es "rendimiento" el servidor recalcula la
     * cantidad (area_o_volumen / rendimiento) en vez de confiar en el valor
     * que mandó el JavaScript del navegador.
     */
    private function prepararLineasMateriales(array $materialesRequest): array
    {
        $lineas = [];

        foreach ($materialesRequest as $item) {

            if (empty($item['id_material'])) {
                continue;
            }

            $material = Material::find($item['id_material']);

            if (!$material) {
                continue;
            }

            $modoCalculo = $item['modo_calculo'] ?? 'manual';
            $areaOVolumen = null;
            $rendimiento = null;

            if ($modoCalculo === 'rendimiento') {

                $areaOVolumen = isset($item['area_o_volumen']) ? (float) $item['area_o_volumen'] : 0;
                $rendimiento = isset($item['rendimiento']) ? (float) $item['rendimiento'] : 0;

                if ($areaOVolumen <= 0 || $rendimiento <= 0) {
                    // Datos insuficientes para calcular; se omite esta línea.
                    continue;
                }

                $cantidad = round($areaOVolumen / $rendimiento, 2);

            } else {

                $modoCalculo = 'manual';
                $cantidad = isset($item['cantidad']) ? (float) $item['cantidad'] : 0;

                if ($cantidad <= 0) {
                    continue;
                }
            }

            $importe = $cantidad * $material->precio_unitario;

            $lineas[] = [
                'id_material' => $material->id_material,
                'cantidad' => $cantidad,
                'precio_unitario' => $material->precio_unitario,
                'importe' => $importe,
                'modo_calculo' => $modoCalculo,
                'area_o_volumen' => $areaOVolumen,
                'rendimiento' => $rendimiento,
            ];
        }

        return $lineas;
    }

    /**
     * Crea los registros de DetallePresupuesto a partir de las líneas ya
     * normalizadas por prepararLineasMateriales().
     */
    private function guardarLineasMateriales(int $idPresupuesto, array $lineas): void
    {
        foreach ($lineas as $linea) {

            DetallePresupuesto::create([
                'id_presupuesto' => $idPresupuesto,
                'id_material' => $linea['id_material'],
                'cantidad' => $linea['cantidad'],
                'precio_unitario' => $linea['precio_unitario'],
                'importe' => $linea['importe'],
                'modo_calculo' => $linea['modo_calculo'],
                'area_o_volumen' => $linea['area_o_volumen'],
                'rendimiento' => $linea['rendimiento'],
            ]);
        }
    }
}