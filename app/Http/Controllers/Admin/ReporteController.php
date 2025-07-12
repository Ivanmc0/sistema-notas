<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {
        $anios = \App\Models\AnioLectivo::all();
        $grados = \App\Models\Grado::all();
        $cursos = \App\Models\Curso::all();
        $materias = \App\Models\Materia::all();

        return view('admin.reportes.index', compact('anios', 'grados', 'cursos', 'materias'));
    }

    public function previewEstudiante(Request $request)
    {
        $query = \App\Models\User::query()->where('tipo', 'estudiante');

        if ($request->filled('anio_lectivo')) {
            $query->whereHas('matriculas.curso', function($q) use ($request) {
                $q->where('anio_lectivo_id', $request->anio_lectivo);
            });
        }
        if ($request->filled('grado')) {
            $query->whereHas('matriculas.curso.grado', function($q) use ($request) {
                $q->where('id', $request->grado);
            });
        }
        if ($request->filled('curso')) {
            $query->whereHas('matriculas', function($q) use ($request) {
                $q->where('curso_id', $request->curso);
            });
        }
        if ($request->filled('materia')) {
            $query->whereHas('notas', function($q) use ($request) {
                $q->where('materia_id', $request->materia);
            });
        }
        if ($request->filled('busqueda')) {
            $busqueda = $request->busqueda;
            $query->where(function($q) use ($busqueda) {
                $q->where('name', 'like', "%$busqueda%")
                  ->orWhere('documento', 'like', "%$busqueda%") ;
            });
        }

        $estudiantes = $query->with(['matriculas.curso.grado', 'notas.materia'])->get();

        // Renderizar tabla HTML
        $html = view('admin.reportes.partials.tabla_estudiantes', compact('estudiantes'))->render();
        return response()->json(['html' => $html]);
    }
} 