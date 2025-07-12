<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AnioLectivoController;
use App\Http\Controllers\Admin\GradoController;
use App\Http\Controllers\Admin\CursoController;
use App\Http\Controllers\Admin\MateriaController;
use App\Http\Controllers\Admin\PeriodoController;
use App\Http\Controllers\Admin\MatriculaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RelacionFamiliarController;
use App\Http\Controllers\Admin\AsignacionController;
use App\Http\Controllers\Admin\NotaController;

use App\Models\Curso;
use App\Models\Asignacion;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('grados', GradoController::class);
});

// Año Lectivo
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('anio-lectivo', AnioLectivoController::class)->names([
        'index' => 'anio.index',
        'create' => 'anio.create',
        'store' => 'anio.store',
        'show' => 'anio.show',
        'edit' => 'anio.edit',
        'update' => 'anio.update',
        'destroy' => 'anio.destroy',
    ]);
});

// Grados
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('grados', GradoController::class)->names([
        'index' => 'grado.index',
        'create' => 'grado.create',
        'store' => 'grado.store',
        'show' => 'grado.show',
        'edit' => 'grado.edit',
        'update' => 'grado.update',
        'destroy' => 'grado.destroy',
    ]);
});

//Cursos
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('cursos', CursoController::class)->names([
        'index' => 'curso.index',
        'create' => 'curso.create',
        'store' => 'curso.store',
        'show' => 'curso.show',
        'edit' => 'curso.edit',
        'update' => 'curso.update',
        'destroy' => 'curso.destroy',
    ]);
});

//materias
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('materias', MateriaController::class)->names([
        'index' => 'materia.index',
        'create' => 'materia.create',
        'store' => 'materia.store',
        'show' => 'materia.show',
        'edit' => 'materia.edit',
        'update' => 'materia.update',
        'destroy' => 'materia.destroy',
    ]);
});

//periodos
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('periodos', PeriodoController::class)->names([
        'index' => 'periodo.index',
        'create' => 'periodo.create',
        'store' => 'periodo.store',
        'show' => 'periodo.show',
        'edit' => 'periodo.edit',
        'update' => 'periodo.update',
        'destroy' => 'periodo.destroy',
    ]);
});

//matricula
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('matriculas', MatriculaController::class)->names([
        'index' => 'matricula.index',
        'create' => 'matricula.create',
        'store' => 'matricula.store',
        'show' => 'matricula.show',
        'edit' => 'matricula.edit',
        'update' => 'matricula.update',
        'destroy' => 'matricula.destroy',
    ]);
});

// Gestión AJAX
Route::post('api/estudiantes/store', [UserController::class, 'storeEstudiante'])->name('api.estudiantes.store');
Route::post('api/acudientes/store', [UserController::class, 'storeAcudiente'])->name('api.acudientes.store');
Route::put('relaciones/{relacion}', [RelacionFamiliarController::class, 'update'])->name('relacion.update');

// [Opcional] Panel de usuarios
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('usuarios', [UserController::class, 'index'])->name('usuario.index');
});

//Asignaciones
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('asignaciones', AsignacionController::class)->names([
        'index' => 'asignacion.index',
        'create' => 'asignacion.create',
        'store' => 'asignacion.store',
        'show' => 'asignacion.show',
        'edit' => 'asignacion.edit',
        'update' => 'asignacion.update',
        'destroy' => 'asignacion.destroy',
    ])
    ->parameters(['asignaciones' => 'asignacion']);
});

//Notas
Route::get('admin/notas/seleccionar', [App\Http\Controllers\Admin\NotaController::class, 'seleccionar'])->name('nota.seleccionar');

//Rutas AJAX para selects anidados
Route::middleware(['auth'])->prefix('api')->group(function () {

    // Cursos por año lectivo
    Route::get('cursos/{anio}', function ($anioId) {
        return Curso::with('grado')
            ->where('anio_lectivo_id', $anioId)
            ->get();
    });

    // Asignaciones por curso y docente autenticado
    Route::get('asignaciones/{curso}', function ($cursoId) {
        $docenteId = auth()->id();

        return Asignacion::with('materia')
            ->where('curso_id', $cursoId)
            ->where('profesor_id', $docenteId)
            ->get();
    });

    // Puedes agregar aquí: estudiantes del curso, periodos, etc.
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('notas/seleccionar', [NotaController::class, 'seleccionar'])->name('nota.seleccionar');
    Route::get('notas/registro', [NotaController::class, 'registro'])->name('nota.registro');
    Route::post('notas', [NotaController::class, 'store'])->name('nota.store');
});

// Rutas para el módulo de reportes (solo admin)
// Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
//     Route::get('reportes', [\App\Http\Controllers\Admin\ReporteController::class, 'index'])->name('reportes.index');
// });

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('reportes', [\App\Http\Controllers\Admin\ReporteController::class, 'index'])->name('reportes.index');
    Route::post('reportes/preview-estudiante', [\App\Http\Controllers\Admin\ReporteController::class, 'previewEstudiante'])->name('reportes.preview.estudiante');
});

// Rutas AJAX para selects dependientes en reportes
Route::middleware(['auth'])->prefix('api')->group(function () {
    // Grados por año lectivo
    Route::get('grados/{anio}', function ($anioId) {
        return \App\Models\Grado::where('anio_lectivo_id', $anioId)->get();
    });
    // Cursos por año lectivo y grado
    Route::get('cursos/{anio}/{grado?}', function ($anioId, $gradoId = null) {
        $query = \App\Models\Curso::with('grado')->where('anio_lectivo_id', $anioId);
        if ($gradoId) {
            $query->where('grado_id', $gradoId);
        }
        return $query->get();
    });
    // Materias por curso
    Route::get('materias/{curso}', function ($cursoId) {
        return \App\Models\Materia::where('curso_id', $cursoId)->get();
    });
});



