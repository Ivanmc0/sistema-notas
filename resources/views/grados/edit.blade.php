@extends('layouts.admin')

@section('title', 'Editar Grado')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Editar Grado</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('grados.update', $grado) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre del Grado</label>
                <input type="text" name="nombre" class="form-control" value="{{ $grado->nombre }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('grados.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
