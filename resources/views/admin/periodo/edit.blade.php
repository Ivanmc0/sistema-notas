@extends('layouts.admin')

@section('title', isset($periodo) ? 'Editar Periodo' : 'Nuevo Periodo')

@section('content')
<div class="card">
    <div class="card-header"><h3>{{ isset($periodo) ? 'Editar' : 'Crear' }} Periodo</h3></div>
    <div class="card-body">
        <form action="{{ isset($periodo) ? route('periodo.update', $periodo) : route('periodo.store') }}" method="POST">
            @csrf
            @if(isset($periodo)) @method('PUT') @endif

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input name="nombre" type="text" class="form-control" value="{{ old('nombre', $periodo->nombre ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="inicio">Fecha de inicio</label>
                <input name="inicio" type="date" class="form-control" value="{{ old('inicio', $periodo->inicio ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="fin">Fecha de fin</label>
                <input name="fin" type="date" class="form-control" value="{{ old('fin', $periodo->fin ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="anio_lectivo_id">Año lectivo</label>
                <select name="anio_lectivo_id" class="form-control" required>
                    <option value="">Seleccione un año</option>
                    @foreach($anios as $anio)
                        <option value="{{ $anio->id }}" {{ old('anio_lectivo_id', $periodo->anio_lectivo_id ?? '') == $anio->id ? 'selected' : '' }}>
                            {{ $anio->anio }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success">{{ isset($periodo) ? 'Actualizar' : 'Guardar' }}</button>
            <a href="{{ route('periodo.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
