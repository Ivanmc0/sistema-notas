@extends('layouts.admin')

@section('title', isset($grado) ? 'Editar Grado' : 'Nuevo Grado')

@section('content')
<div class="card">
    <div class="card-header"><h3>{{ isset($grado) ? 'Editar' : 'Crear' }} Grado</h3></div>
    <div class="card-body">
        <form action="{{ isset($grado) ? route('grado.update', $grado) : route('grado.store') }}" method="POST">
            @csrf
            @if(isset($grado)) @method('PUT') @endif

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input name="nombre" type="text" class="form-control" value="{{ old('nombre', $grado->nombre ?? '') }}" required>
            </div>
            <button class="btn btn-success">{{ isset($grado) ? 'Actualizar' : 'Guardar' }}</button>
            <a href="{{ route('grado.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
