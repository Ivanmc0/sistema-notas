@extends('layouts.admin')

@section('title', 'Nueva Matrícula')

@section('content')
<div class="card">
    <div class="card-header"><h3>Registrar Matrícula</h3></div>
    <div class="card-body">
        <form id="form-matricula" action="{{ route('matricula.store') }}" method="POST">

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

            {{-- Año lectivo y curso --}}
            <div class="form-group">
                <label for="curso_id">Curso (por Año Lectivo)</label>
                <select name="curso_id" id="curso_id" class="form-control" required>
                    <option value="">Seleccione un curso</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}">
                            {{ $curso->anioLectivo->anio }} - {{ $curso->grado->nombre }} {{ $curso->seccion }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Estudiante --}}
            <div class="form-group">
                <label for="estudiante_id">Estudiante</label>
                <div class="input-group">
                    <select name="estudiante_id" id="estudiante_id" class="form-control" required>
                        <option value="">Seleccione un estudiante</option>
                        @foreach($estudiantes as $est)
                            <option value="{{ $est->id }}">{{ $est->name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCrearEstudiante">
                            + Crear
                        </button>
                    </div>
                </div>
            </div>

            {{-- Acudiente --}}
            <div class="form-group">
                <label for="acudiente_id">Acudiente</label>
                <div class="input-group">
                    <select name="acudiente_id" id="acudiente_id" class="form-control" required>
                        <option value="">Seleccione un acudiente</option>
                        @foreach($acudientes as $a)
                            <option value="{{ $a->id }}">{{ $a->name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCrearAcudiente">
                            + Crear
                        </button>
                    </div>
                </div>
            </div>

            {{-- Parentesco --}}
            <div class="form-group">
                <label for="parentesco">Parentesco</label>
                <input type="text" name="parentesco" class="form-control" required placeholder="Ej: Madre, Padre, Tío...">
            </div>

            <button class="btn btn-primary">Guardar Matrícula</button>
        </form>
    </div>
</div>

@include('admin.matricula.modales.estudiante')
@include('admin.matricula.modales.acudiente')
@endsection
