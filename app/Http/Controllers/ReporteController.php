<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function index()
    {
        $presupuestos = Presupuesto::orderBy('id_presupuesto', 'desc')->get();

        return view('reportes.index', compact('presupuestos'));
    }

    public function presupuesto($id)
    {
        $presupuesto = Presupuesto::with('detalles.material')
            ->findOrFail($id);

        return view('reportes.presupuesto', compact('presupuesto'));
    }

    /**
     * Genera y descarga el presupuesto como archivo PDF.
     */
    public function descargarPdf($id)
    {
        $presupuesto = Presupuesto::with('detalles.material')
            ->findOrFail($id);

        $pdf = Pdf::loadView('reportes.presupuesto', [
            'presupuesto' => $presupuesto,
            'paraPdf' => true,
        ]);

        $nombreArchivo = 'Presupuesto-' . str_pad($presupuesto->id_presupuesto, 4, '0', STR_PAD_LEFT) . '.pdf';

        return $pdf->download($nombreArchivo);
    }
}