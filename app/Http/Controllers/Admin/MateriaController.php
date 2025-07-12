<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use App\Models\Grado;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::with('grado')->orderBy('nombre')->get();
        return view('admin.materia.index', compact('materias'));
    }

    public function create()
    {
        $grados = Grado::orderBy('nombre')->get();
        return view('admin.materia.create', compact('grados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'grado_id' => 'required|exists:grados,id',
        ]);

        Materia::create($request->only('nombre', 'grado_id'));

        return redirect()->route('materia.index')->with('success', 'Materia creada correctamente.');
    }

    public function edit(Materia $materia)
    {
        $grados = Grado::orderBy('nombre')->get();
        return view('admin.materia.edit', compact('materia', 'grados'));
    }

    public function update(Request $request, Materia $materia)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'grado_id' => 'required|exists:grados,id',
        ]);

        $materia->update($request->only('nombre', 'grado_id'));

        return redirect()->route('materia.index')->with('success', 'Materia actualizada correctamente.');
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();
        return redirect()->route('materia.index')->with('success', 'Materia eliminada correctamente.');
    }
}
