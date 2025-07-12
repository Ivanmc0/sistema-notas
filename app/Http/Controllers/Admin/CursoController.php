<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Grado;
use App\Models\AnioLectivo;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::with(['grado', 'anioLectivo'])->orderBy('id')->get();
        return view('admin.curso.index', compact('cursos'));
    }

    public function create()
    {
        $grados = Grado::orderBy('nombre')->get();
        $anios = AnioLectivo::orderByDesc('anio')->get();
        return view('admin.curso.create', compact('grados', 'anios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grado_id' => 'required|exists:grados,id',
            'anio_lectivo_id' => 'required|exists:anio_lectivo,id',
            'seccion' => 'required|string|max:10',
        ]);

        Curso::create($request->only('grado_id', 'anio_lectivo_id', 'seccion'));

        return redirect()->route('curso.index')->with('success', 'Curso creado correctamente.');
    }

    public function edit(Curso $curso)
    {
        $grados = Grado::orderBy('nombre')->get();
        $anios = AnioLectivo::orderByDesc('anio')->get();
        return view('admin.curso.edit', compact('curso', 'grados', 'anios'));
    }

    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'grado_id' => 'required|exists:grados,id',
            'anio_lectivo_id' => 'required|exists:anio_lectivo,id',
            'seccion' => 'required|string|max:10',
        ]);

        $curso->update($request->only('grado_id', 'anio_lectivo_id', 'seccion'));

        return redirect()->route('curso.index')->with('success', 'Curso actualizado correctamente.');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('curso.index')->with('success', 'Curso eliminado correctamente.');
    }
}
