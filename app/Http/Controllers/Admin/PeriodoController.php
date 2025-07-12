<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Periodo;
use App\Models\AnioLectivo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    public function index()
    {
        $periodos = Periodo::with('anioLectivo')->orderByDesc('inicio')->get();
        return view('admin.periodo.index', compact('periodos'));
    }

    public function create()
    {
        $anios = AnioLectivo::orderByDesc('anio')->get();
        return view('admin.periodo.create', compact('anios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'inicio' => 'required|date',
            'fin' => 'required|date|after_or_equal:inicio',
            'anio_lectivo_id' => 'required|exists:anio_lectivo,id',
        ]);

        Periodo::create($request->only('nombre', 'inicio', 'fin', 'anio_lectivo_id'));

        return redirect()->route('periodo.index')->with('success', 'Periodo creado correctamente.');
    }

    public function edit(Periodo $periodo)
    {
        $anios = AnioLectivo::orderByDesc('anio')->get();
        return view('admin.periodo.edit', compact('periodo', 'anios'));
    }

    public function update(Request $request, Periodo $periodo)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'inicio' => 'required|date',
            'fin' => 'required|date|after_or_equal:inicio',
            'anio_lectivo_id' => 'required|exists:anio_lectivo,id',
        ]);

        $periodo->update($request->only('nombre', 'inicio', 'fin', 'anio_lectivo_id'));

        return redirect()->route('periodo.index')->with('success', 'Periodo actualizado correctamente.');
    }

    public function destroy(Periodo $periodo)
    {
        $periodo->delete();
        return redirect()->route('periodo.index')->with('success', 'Periodo eliminado correctamente.');
    }
}
