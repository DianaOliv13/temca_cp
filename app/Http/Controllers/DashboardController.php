<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $nombreUsuario = auth()->user()->name ?? auth()->user()->email ?? null;

        $fechaHoy = Carbon::now()->locale('es')->isoFormat('dddd D [de] MMMM [de] YYYY');
        $fechaHoy = ucfirst($fechaHoy);

        return view('dashboard', compact(
            'nombreUsuario',
            'fechaHoy'
        ));
    }
}