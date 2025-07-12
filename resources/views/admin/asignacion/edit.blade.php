@extends('layouts.admin')

@section('title', 'Editar Asignación')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Editar Asignación</h5>
        <a href="{{ route('asignacion.index') }}" class="btn btn-secondary">← Volver</a>
    </div>
    <div class="card-body">
        <form action="{{ route('asignacion.update', $asignacion) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="profesor_id">Docente</label>
                <select name="profesor_id" class="form-control" required>
                    @foreach($docentes as $docente)
                        <option value="{{ $docente->id }}" {{ $docente->id == $asignacion->profesor_id ? 'selected' : '' }}>
                            {{ $docente->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="curso_id">Curso</label>
                <select name="curso_id" class="form-control" required>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}" {{ $curso->id == $asignacion->curso_id ? 'selected' : '' }}>
                            {{ $curso->grado->nombre }} - {{ $curso->seccion }} ({{ $curso->anioLectivo->anio }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="materia_id">Materia</label>
                <select name="materia_id" class="form-control" required>
                    @foreach($materias as $materia)
                        <option value="{{ $materia->id }}" {{ $materia->id == $asignacion->materia_id ? 'selected' : '' }}>
                            {{ $materia->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Actualizar</button>
            <a href="{{ route('asignacion.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
