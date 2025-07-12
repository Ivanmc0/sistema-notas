@extends('layouts.admin')

@section('title', 'Editar Año Lectivo')

@section('content')
<div class="card">
    <div class="card-header"><h3>Editar Año Lectivo</h3></div>
    <div class="card-body">
        <form action="{{ route('anio.update', $anio_lectivo) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="anio">Año</label>
                <input type="number" name="anio" class="form-control" value="{{ $anio_lectivo->anio }}" required>
            </div>

            <div class="form-group">
                <label for="activo">Estado</label>
                <select name="activo" class="form-control" required>
                    <option value="1" {{ $anio_lectivo->estado ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ !$anio_lectivo->estado ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <button class="btn btn-primary">Actualizar</button>
            <a href="{{ route('anio.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
