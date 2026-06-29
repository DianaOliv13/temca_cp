<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Mostrar listado de proveedores.
     */
    public function index()
    {
        $proveedores = Proveedor::orderBy('nombre')->get();

        return view('proveedor.index', compact('proveedores'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('proveedor.create');
    }

    /**
     * Guardar un nuevo proveedor.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:150',
            'telefono' => 'nullable|string|max:20',
            'correo'   => 'nullable|email|max:100',
            'rfc'      => 'nullable|string|max:20',
        ]);

        Proveedor::create([
            'nombre'   => $request->nombre,
            'telefono' => $request->telefono,
            'correo'   => $request->correo,
            'rfc'      => $request->rfc,
        ]);

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor registrado correctamente.');
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Proveedor $proveedor)
    {
        return view('proveedor.edit', compact('proveedor'));
    }

    /**
     * Actualizar proveedor.
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $request->validate([
            'nombre'   => 'required|string|max:150',
            'telefono' => 'nullable|string|max:20',
            'correo'   => 'nullable|email|max:100',
            'rfc'      => 'nullable|string|max:20',
        ]);

        $proveedor->update([
            'nombre'   => $request->nombre,
            'telefono' => $request->telefono,
            'correo'   => $request->correo,
            'rfc'      => $request->rfc,
        ]);

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor actualizado correctamente.');
    }

    /**
     * Eliminar proveedor.
     */
    public function destroy(Proveedor $proveedor)
    {
        try {

            $proveedor->delete();

            return redirect()
                ->route('proveedores.index')
                ->with('success', 'Proveedor eliminado correctamente.');

        } catch (\Exception $e) {

            return redirect()
                ->route('proveedores.index')
                ->with('error', 'No se puede eliminar este proveedor porque tiene materiales asociados.');

        }
    }
}