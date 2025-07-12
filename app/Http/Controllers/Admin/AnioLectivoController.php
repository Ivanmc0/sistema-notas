<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnioLectivo;
use Illuminate\Http\Request;

class AnioLectivoController extends Controller
{
    public function index()
    {
        $anios = AnioLectivo::orderByDesc('anio')->get();
        return view('admin.anio.index', compact('anios'));
    }

    public function create()
    {
        return view('admin.anio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'anio' => 'required|integer|unique:anio_lectivo,anio',
            'activo' => 'required|in:0,1',
        ]);

        AnioLectivo::create($request->only('anio', 'activo'));
        return redirect()->route('anio.index')->with('success', 'Año lectivo creado correctamente.');
    }

    public function edit(AnioLectivo $anio_lectivo)
    {
        return view('admin.anio.edit', compact('anio_lectivo'));
    }

    public function update(Request $request, AnioLectivo $anio_lectivo)
    {
        $request->validate([
            'anio' => 'required|integer|unique:anio_lectivo,anio,' . $anio_lectivo->id,
            'activo' => 'required|in:0,1',
        ]);

        $anio_lectivo->update($request->only('anio', 'activo'));
        return redirect()->route('anio.index')->with('success', 'Año lectivo actualizado correctamente.');
    }

    public function destroy(AnioLectivo $anio_lectivo)
    {
        $anio_lectivo->delete();
        return redirect()->route('anio.index')->with('success', 'Año lectivo eliminado correctamente.');
    }
}
