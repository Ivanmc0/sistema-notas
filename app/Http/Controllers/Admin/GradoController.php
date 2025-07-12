<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grado;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    public function index()
    {
        $grados = Grado::orderBy('nombre')->get();
        return view('admin.grado.index', compact('grados'));
    }

    public function create()
    {
        return view('admin.grado.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:grados,nombre',
        ]);

        Grado::create($request->only('nombre'));

        return redirect()->route('grado.index')->with('success', 'Grado creado correctamente.');
    }

    public function edit(Grado $grado)
    {
        return view('admin.grado.edit', compact('grado'));
    }

    public function update(Request $request, Grado $grado)
    {
        $request->validate([
            'nombre' => 'required|string|unique:grados,nombre,' . $grado->id,
        ]);

        $grado->update($request->only('nombre'));

        return redirect()->route('grado.index')->with('success', 'Grado actualizado correctamente.');
    }

    public function destroy(Grado $grado)
    {
        $grado->delete();
        return redirect()->route('grado.index')->with('success', 'Grado eliminado correctamente.');
    }
}

