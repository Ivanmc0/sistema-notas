@extends('layouts.admin')

@section('title', 'Detalle de Matrícula')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card">

    <div class="card-header">
        <div class="row w-100">
            <div class="col">
                <a href="{{ route('matricula.index') }}" class="btn btn-secondary">
                    ← Volver
                </a>
            </div>
            <div class="col text-right">
                <a href="{{ route('matricula.edit', $matricula) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('matricula.destroy', $matricula) }}" method="POST" class="d-inline-block">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('¿Eliminar esta matrícula?')">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
    
    <div style="padding-left: 20px; margin-top: 10px;">
        <h4>Información de Matrícula</h4>
    </div>

    <div class="card-body">
        <p><strong>Estudiante:</strong> {{ $matricula->estudiante->name }}</p>
        <p><strong>Curso:</strong> {{ $matricula->curso->grado->nombre ?? '' }} - {{ $matricula->curso->seccion }}</p>
        <p><strong>Año lectivo:</strong> {{ $matricula->curso->anioLectivo->anio }}</p>

        @if($relacion && $relacion->acudiente)
            <hr>
            <h5>Información del Acudiente</h5>
            <p><strong>Nombre:</strong> {{ $relacion->acudiente->name }}</p>
            <p><strong>Email:</strong> {{ $relacion->acudiente->email }}</p>
            <p><strong>Celular:</strong> {{ $relacion->acudiente->celular ?? 'No registrado' }}</p>
            <p><strong>Parentesco:</strong> {{ $relacion->parentesco }}</p>
        @else
            <hr>
            <p><strong>Acudiente:</strong> No registrado</p>
        @endif
        @if($relacion && $relacion->acudiente)
            <hr>
            <h5>Información del Acudiente</h5>
            <p><strong>Nombre:</strong> {{ $relacion->acudiente->name }}</p>
            <p><strong>Email:</strong> {{ $relacion->acudiente->email }}</p>
            <p><strong>Celular:</strong> {{ $relacion->acudiente->celular ?? 'No registrado' }}</p>
            <p><strong>Parentesco:</strong> {{ $relacion->parentesco }}</p>

            <!-- Botón para abrir el modal -->
            <button type="button" class="btn btn-secondary mt-2" data-toggle="modal" data-target="#modalEditarRelacion">
                Editar Acudiente
            </button>
        @endif

    </div>

</div>
@endsection

@if($relacion)
    <div class="modal fade" id="modalEditarRelacion" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('relacion.update', $relacion->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header"><h5 class="modal-title">Actualizar relación familiar</h5></div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="acudiente_id">Acudiente</label>
                            <select name="acudiente_id" class="form-control" required>
                                @foreach($acudientes as $acudiente)
                                    <option value="{{ $acudiente->id }}" {{ $acudiente->id == $relacion->padre_id ? 'selected' : '' }}>
                                        {{ $acudiente->name }} ({{ $acudiente->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="parentesco">Parentesco</label>
                            <input name="parentesco" type="text" class="form-control" value="{{ $relacion->parentesco }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Guardar cambios</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif


