@extends('layouts.admin')

@section('title', 'Nuevo Año Lectivo')

@section('content')
<div class="card">
    <div class="card-header"><h3>Crear Año Lectivo</h3></div>
    <div class="card-body">
        <form action="{{ route('anio.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="anio">Año</label>
                <input type="number" name="anio" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="activo">Estado</label>
                <select name="activo" class="form-control" required>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>

            <button class="btn btn-success">Guardar</button>
            <a href="{{ route('anio.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
