<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'periodo_id' => 'required|exists:periodos,id',
            'asignacion_id' => 'required|exists:asignaciones,id',
            'notas' => 'required|array',
        ]);

        foreach ($request->notas as $estudianteId => $periodos) {
            if (isset($periodos[$request->periodo_id])) {
                $valor = $periodos[$request->periodo_id];

                // Buscar la matrícula correspondiente
                $matricula = \App\Models\Matricula::where('curso_id', function ($q) use ($request) {
                        $q->select('curso_id')
                          ->from('asignaciones')
                          ->where('id', $request->asignacion_id)
                          ->limit(1);
                    })
                    ->where('estudiante_id', $estudianteId)
                    ->first();

                if (!$matricula) {
                    continue; // O manejar error si se requiere
                }

                \App\Models\Nota::updateOrCreate(
                    [
                        'asignacion_id' => $request->asignacion_id,
                        'periodo_id' => $request->periodo_id,
                        'matricula_id' => $matricula->id,
                    ],
                    [
                        'calificacion' => $valor,
                        'estudiante_id' => $estudianteId, // útil si quieres redundancia
                    ]
                );
            }
        }

        return back()->with('success', 'Notas guardadas correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function seleccionar()
    {
        $anios = \App\Models\AnioLectivo::orderBy('anio', 'desc')->get();
        return view('admin.nota.seleccion', compact('anios'));
    }

    public function registro(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'asignacion_id' => 'required|exists:asignaciones,id',
        ]);

        $curso = \App\Models\Curso::with('grado', 'anioLectivo')->findOrFail($request->curso_id);
        $asignacion = \App\Models\Asignacion::with('materia')->findOrFail($request->asignacion_id);
        $periodos = \App\Models\Periodo::where('anio_lectivo_id', $curso->anio_lectivo_id)->get();
        $periodoActivo = $periodos->first(); // puedes ajustar cómo defines esto

        $estudiantes = \App\Models\User::where('tipo', 'estudiante')
            ->whereHas('matriculas', fn($q) => $q->where('curso_id', $curso->id))
            ->get();

        $notas = \App\Models\Nota::where('asignacion_id', $asignacion->id)->get();

        return view('admin.nota.registro', compact('curso', 'asignacion', 'periodos', 'periodoActivo', 'estudiantes', 'notas'));
    }

}
