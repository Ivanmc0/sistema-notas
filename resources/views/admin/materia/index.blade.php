@extends('layouts.admin')

@section('title', 'Materias')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Materias</h3>
        <a href="{{ route('materia.create') }}" class="btn btn-primary float-right">Nueva Materia</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">N°</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Grado</th>
                    <th class="text-center" style="width: 300px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materias as $materia)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $materia->nombre }}</td>
                        <td>{{ $materia->grado->nombre }}</td>
                        <td>
                            <a href="{{ route('materia.edit', $materia) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('materia.destroy', $materia) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('¿Eliminar esta materia?')" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
