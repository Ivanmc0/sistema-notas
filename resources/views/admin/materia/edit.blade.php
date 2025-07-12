@extends('layouts.admin')

@section('title', isset($materia) ? 'Editar Materia' : 'Nueva Materia')

@section('content')
<div class="card">
    <div class="card-header"><h3>{{ isset($materia) ? 'Editar' : 'Crear' }} Materia</h3></div>
    <div class="card-body">
        <form action="{{ isset($materia) ? route('materia.update', $materia) : route('materia.store') }}" method="POST">
            @csrf
            @if(isset($materia)) @method('PUT') @endif

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input name="nombre" type="text" class="form-control" value="{{ old('nombre', $materia->nombre ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="grado_id">Grado</label>
                <select name="grado_id" class="form-control" required>
                    <option value="">Seleccione un grado</option>
                    @foreach($grados as $grado)
                        <option value="{{ $grado->id }}" {{ old('grado_id', $materia->grado_id ?? '') == $grado->id ? 'selected' : '' }}>
                            {{ $grado->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success">{{ isset($materia) ? 'Actualizar' : 'Guardar' }}</button>
            <a href="{{ route('materia.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
