@extends('layouts.admin')

@section('title', isset($materia) ? 'Editar Materia' : 'Nueva Materia')

@section('content')

<form action="{{ route('asignacion.store') }}" method="POST">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @csrf

    <div class="form-group">
        <label for="profesor_id">Docente</label>
        <select name="profesor_id" class="form-control" required>
            @foreach($docentes as $docente)
                <option value="{{ $docente->id }}">{{ $docente->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="curso_id">Curso</label>
        <select name="curso_id" class="form-control" required>
            @foreach($cursos as $curso)
                <option value="{{ $curso->id }}">{{ $curso->grado->nombre }} - {{ $curso->seccion }} ({{ $curso->anioLectivo->anio }})</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="materia_id">Materia</label>
        <select name="materia_id" class="form-control" required>
            @foreach($materias as $materia)
                <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary">Guardar</button>
</form>
@endsection