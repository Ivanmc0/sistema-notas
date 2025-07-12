@extends('layouts.admin')

@section('title', 'Asignaciones')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Asignaciones de Docentes</h5>
        <a href="{{ route('asignacion.create') }}" class="btn btn-primary">Nueva asignación</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Docente</th>
                    <th>Curso</th>
                    <th>Grado</th>
                    <th>Año Lectivo</th>
                    <th>Materia</th>
                    <th class="text-right" style="width: 300px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($asignaciones as $asignacion)
                    <tr>
                        <td>{{ $asignacion->profesor->name }}</td>
                        <td>{{ $asignacion->curso->seccion }}</td>
                        <td>{{ $asignacion->curso->grado->nombre }}</td>
                        <td>{{ $asignacion->curso->anioLectivo->anio }}</td>
                        <td>{{ $asignacion->materia->nombre }}</td>
                        <td class="text-right">
                            <a href="{{ route('asignacion.edit', $asignacion) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('asignacion.destroy', $asignacion) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta asignación?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No hay asignaciones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
