<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matricula;
use App\Models\User;
use App\Models\Curso;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index()
    {
        $matriculas = Matricula::with(['estudiante', 'curso'])->latest()->get();
        return view('admin.matricula.index', compact('matriculas'));
    }

    public function create()
    {
        $estudiantes = User::where('tipo', 'estudiante')->orderBy('name')->get();
        $acudientes = User::where('tipo', 'acudiente')->orderBy('name')->get();
        $cursos = Curso::with('grado')->orderBy('id')->get();
        return view('admin.matricula.create', compact('estudiantes', 'acudientes', 'cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:users,id',
            'curso_id' => 'required|exists:cursos,id',
            'acudiente_id' => 'required|exists:users,id',
            'parentesco' => 'required|string|max:100',
        ]);

        // Validar que no exista ya matrícula en ese año
        $curso = Curso::with('anioLectivo')->findOrFail($request->curso_id);
        $yaMatriculado = Matricula::where('estudiante_id', $request->estudiante_id)
            ->whereHas('curso', fn($q) => $q->where('anio_lectivo_id', $curso->anio_lectivo_id))
            ->exists();

        if ($yaMatriculado) {
            return back()->withErrors(['estudiante_id' => 'Ya está matriculado en este año.']);
        }

        // Registrar la matrícula
        $matricula = Matricula::create([
            'estudiante_id' => $request->estudiante_id,
            'curso_id' => $request->curso_id,
        ]);

        // Registrar o actualizar relación familiar
        \App\Models\RelacionFamiliar::updateOrCreate(
            [
                'estudiante_id' => $request->estudiante_id,
                'padre_id' => $request->acudiente_id, // el campo real
            ]
        );

        return redirect()->route('matricula.index')->with('success', 'Matrícula registrada con éxito.');
    }


    public function edit(Matricula $matricula)
    {
        $estudiantes = User::where('tipo', 'estudiante')->orderBy('name')->get();
        $cursos = Curso::with('grado')->orderBy('id')->get();
        return view('admin.matricula.edit', compact('matricula', 'estudiantes', 'cursos'));
    }

    public function update(Request $request, Matricula $matricula)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:users,id',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        $matricula->update($request->only('estudiante_id', 'curso_id'));

        return redirect()->route('matricula.index')->with('success', 'Matrícula actualizada correctamente.');
    }

    public function destroy(Matricula $matricula)
    {
        $matricula->delete();
        return redirect()->route('matricula.index')->with('success', 'Matrícula eliminada.');
    }

    public function show(Matricula $matricula)
    {
        $matricula->load('estudiante', 'curso.grado', 'curso.anioLectivo');
        $acudientes = \App\Models\User::where('tipo', 'acudiente')->get();

        $relacion = \App\Models\RelacionFamiliar::with('acudiente')
            ->where('estudiante_id', $matricula->estudiante_id)
            ->whereNotNull('padre_id')
            ->first();

        return view('admin.matricula.show', compact('matricula', 'relacion', 'acudientes'));
    }
}
