<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Proveedor;
use App\Models\CategoriaMaterial;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Mostrar todos los materiales.
     */
    public function index()
    {
        $materiales = Material::with(['proveedor', 'categoria'])
            ->orderBy('nombre')
            ->get();

        return view('materiales.index', compact('materiales'));
    }

    /**
     * Mostrar formulario para crear material.
     */
    public function create()
    {
        $proveedores = Proveedor::orderBy('nombre')->get();
        $categorias = CategoriaMaterial::orderBy('nombre')->get();

        return view('materiales.create', compact(
            'proveedores',
            'categorias'
        ));
    }

    /**
     * Guardar material.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_proveedor'        => 'required|exists:proveedores,id_proveedor',
            'id_categoria'        => 'required|exists:categorias_material,id_categoria',
            'nombre'              => 'required|string|max:150',
            'descripcion'         => 'nullable|string',
            'unidad'              => 'nullable|string|max:20',
            'precio_unitario'     => 'required|numeric|min:0',
            'fecha_actualizacion' => 'required|date',
            'unidad_rendimiento'  => 'nullable|string|max:50',
        ]);

        Material::create([
            'id_proveedor'        => $request->id_proveedor,
            'id_categoria'        => $request->id_categoria,
            'nombre'              => $request->nombre,
            'descripcion'         => $request->descripcion,
            'unidad'              => $request->unidad,
            'precio_unitario'     => $request->precio_unitario,
            'fecha_actualizacion' => $request->fecha_actualizacion,
            'unidad_rendimiento'  => $request->unidad_rendimiento,
        ]);

        return redirect()
            ->route('materiales.index')
            ->with('success', 'Material registrado correctamente.');
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Material $material)
    {
        $proveedores = Proveedor::orderBy('nombre')->get();
        $categorias = CategoriaMaterial::orderBy('nombre')->get();

        return view('materiales.edit', compact(
            'material',
            'proveedores',
            'categorias'
        ));
    }

    /**
     * Actualizar material.
     */
    public function update(Request $request, Material $material)
    {
        $request->validate([
            'id_proveedor'        => 'required|exists:proveedores,id_proveedor',
            'id_categoria'        => 'required|exists:categorias_material,id_categoria',
            'nombre'              => 'required|string|max:150',
            'descripcion'         => 'nullable|string',
            'unidad'              => 'nullable|string|max:20',
            'precio_unitario'     => 'required|numeric|min:0',
            'fecha_actualizacion' => 'required|date',
            'unidad_rendimiento'  => 'nullable|string|max:50',
        ]);

        $material->update([
            'id_proveedor'        => $request->id_proveedor,
            'id_categoria'        => $request->id_categoria,
            'nombre'              => $request->nombre,
            'descripcion'         => $request->descripcion,
            'unidad'              => $request->unidad,
            'precio_unitario'     => $request->precio_unitario,
            'fecha_actualizacion' => $request->fecha_actualizacion,
            'unidad_rendimiento'  => $request->unidad_rendimiento,
        ]);

        return redirect()
            ->route('materiales.index')
            ->with('success', 'Material actualizado correctamente.');
    }

    /**
     * Eliminar material.
     */
    public function destroy(Material $material)
    {
        try {

            $material->delete();

            return redirect()
                ->route('materiales.index')
                ->with('success', 'Material eliminado correctamente.');

        } catch (\Exception $e) {

            return redirect()
                ->route('materiales.index')
                ->with('error', 'No se puede eliminar este material porque está siendo utilizado en un presupuesto.');

        }
    }
}