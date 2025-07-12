@extends('layouts.admin')

@section('title', isset($matricula) ? 'Editar Matrícula' : 'Nueva Matrícula')

@section('content')
<div class="card">
    <div class="card-header"><h3>{{ isset($matricula) ? 'Editar' : 'Registrar' }} Matrícula</h3></div>
    <div class="card-body">
        <form action="{{ isset($matricula) ? route('matricula.update', $matricula) : route('matricula.store') }}" method="POST">
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
            @if(isset($matricula)) @method('PUT') @endif

            <div class="form-group">
                <label for="estudiante_id">Estudiante</label>
                <select name="estudiante_id" class="form-control" required>
                    <option value="">Seleccione estudiante</option>
                    @foreach($estudiantes as $est)
                        <option value="{{ $est->id }}" {{ old('estudiante_id', $matricula->estudiante_id ?? '') == $est->id ? 'selected' : '' }}>
                            {{ $est->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="curso_id">Curso</label>
                <select name="curso_id" class="form-control" required>
                    <option value="">Seleccione curso</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}" {{ old('curso_id', $matricula->curso_id ?? '') == $curso->id ? 'selected' : '' }}>
                            {{ $curso->grado->nombre }} - {{ $curso->seccion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success">{{ isset($matricula) ? 'Actualizar' : 'Guardar' }}</button>
            <a href="{{ route('matricula.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
