@extends('layouts.admin')

@section('title', 'Nuevo Grado')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Crear Grado</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('grados.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre del Grado</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('grados.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
