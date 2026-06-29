<?php

namespace App\Http\Controllers;

use App\Models\CategoriaMaterial;
use Illuminate\Http\Request;

class CategoriaMaterialController extends Controller
{
    /**
     * Mostrar todas las categorías.
     */
    public function index()
    {
        $categorias = CategoriaMaterial::orderBy('nombre')
            ->get();

        return view(
            'categorias_material.index',
            compact('categorias')
        );
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('categorias_material.create');
    }

    /**
     * Guardar categoría.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:100|unique:categorias_material,nombre',
            'descripcion' => 'nullable|string'
        ]);

        CategoriaMaterial::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        return redirect()
            ->route('categorias-material.index')
            ->with(
                'success',
                'Categoría registrada correctamente.'
            );
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(CategoriaMaterial $categorias_material)
    {
        return view(
            'categorias_material.edit',
            [
                'categoria' => $categorias_material
            ]
        );
    }

    /**
     * Actualizar categoría.
     */
    public function update(
        Request $request,
        CategoriaMaterial $categorias_material
    ) {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias_material,nombre,' .
                $categorias_material->id_categoria .
                ',id_categoria',

            'descripcion' => 'nullable|string'
        ]);

        $categorias_material->update([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        return redirect()
            ->route('categorias-material.index')
            ->with(
                'success',
                'Categoría actualizada correctamente.'
            );
    }

    /**
     * Eliminar categoría.
     */
    public function destroy(
        CategoriaMaterial $categorias_material
    ) {
        try {

            $categorias_material->delete();

            return redirect()
                ->route('categorias-material.index')
                ->with(
                    'success',
                    'Categoría eliminada correctamente.'
                );

        } catch (\Exception $e) {

            return redirect()
                ->route('categorias-material.index')
                ->with(
                    'error',
                    'No se puede eliminar esta categoría porque tiene materiales asociados.'
                );

        }
    }
}