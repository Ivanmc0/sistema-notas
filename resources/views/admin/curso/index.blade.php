@extends('layouts.admin')

@section('title', 'Cursos')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Cursos</h3>
        <a href="{{ route('curso.create') }}" class="btn btn-primary float-right">Nuevo Curso</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">N°</th>
                    <th class="text-center">Grado</th>
                    <th class="text-center">Sección</th>
                    <th class="text-center">Año lectivo</th>
                    <th class="text-center" style="width: 300px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cursos as $curso)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $curso->grado->nombre }}</td>
                        <td>{{ $curso->seccion }}</td>
                        <td>{{ $curso->anioLectivo->anio }}</td>
                        <td>
                            <a href="{{ route('curso.edit', $curso) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('curso.destroy', $curso) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('¿Eliminar este curso?')" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
