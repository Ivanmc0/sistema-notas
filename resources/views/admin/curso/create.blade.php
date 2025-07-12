@extends('layouts.admin')

@section('title', isset($curso) ? 'Editar Curso' : 'Nuevo Curso')

@section('content')
<div class="card">
    <div class="card-header"><h3>{{ isset($curso) ? 'Editar' : 'Crear' }} Curso</h3></div>
    <div class="card-body">
        <form action="{{ isset($curso) ? route('curso.update', $curso) : route('curso.store') }}" method="POST">
            @csrf
            @if(isset($curso)) @method('PUT') @endif

            <div class="form-group">
                <label for="grado_id">Grado</label>
                <select name="grado_id" class="form-control" required>
                    <option value="">Seleccione un grado</option>
                    @foreach($grados as $grado)
                        <option value="{{ $grado->id }}" {{ old('grado_id', $curso->grado_id ?? '') == $grado->id ? 'selected' : '' }}>
                            {{ $grado->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="anio_lectivo_id">Año Lectivo</label>
                <select name="anio_lectivo_id" class="form-control" required>
                    <option value="">Seleccione un año</option>
                    @foreach($anios as $anio)
                        <option value="{{ $anio->id }}" {{ old('anio_lectivo_id', $curso->anio_lectivo_id ?? '') == $anio->id ? 'selected' : '' }}>
                            {{ $anio->anio }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="seccion">Sección</label>
                <input name="seccion" type="text" class="form-control" value="{{ old('seccion', $curso->seccion ?? '') }}" required>
            </div>

            <button class="btn btn-success">{{ isset($curso) ? 'Actualizar' : 'Guardar' }}</button>
            <a href="{{ route('curso.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
