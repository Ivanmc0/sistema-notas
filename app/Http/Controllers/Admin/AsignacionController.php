<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Materia;
use App\Models\Curso;
use App\Models\Asignacion;

class AsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asignaciones = \App\Models\Asignacion::with(['profesor', 'materia', 'curso.grado', 'curso.anioLectivo'])->get();
    
        return view('admin.asignacion.index', compact('asignaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $docentes = User::where('tipo', 'docente')->get();
        $materias = Materia::all();
        $cursos = Curso::with('grado', 'anioLectivo')->get();
    
        return view('admin.asignacion.create', compact('docentes', 'materias', 'cursos'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'profesor_id' => 'required|exists:users,id',
            'materia_id' => 'required|exists:materias,id',
            'curso_id' => 'required|exists:cursos,id',
        ]);
    
        \App\Models\Asignacion::firstOrCreate($request->only(['profesor_id', 'materia_id', 'curso_id']));
    
        return redirect()->route('asignacion.index')->with('success', 'Asignación creada correctamente.');
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
    public function edit(\App\Models\Asignacion $asignacion)
    {
        $docentes = \App\Models\User::where('tipo', 'docente')->get();
        $materias = \App\Models\Materia::all();
        $cursos = \App\Models\Curso::with('grado', 'anioLectivo')->get();

        return view('admin.asignacion.edit', compact('asignacion', 'docentes', 'materias', 'cursos'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Asignacion $asignacion)
    {   //dd($request->all());
        $request->validate([
            'profesor_id' => 'required|exists:users,id',
            'materia_id' => 'required|exists:materias,id',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        $asignacion->update($request->only(['profesor_id', 'materia_id', 'curso_id']));

        return redirect()->route('asignacion.index')->with('success', 'Asignación actualizada correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
