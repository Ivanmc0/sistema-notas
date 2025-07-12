@extends('layouts.admin')

@section('title', 'Periodos')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Periodos</h3>
        <a href="{{ route('periodo.create') }}" class="btn btn-primary float-right">Nuevo Periodo</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Inicio</th>
                    <th class="text-center">Fin</th>
                    <th class="text-center">Año lectivo</th>
                    <th class="text-center" style="width: 300px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($periodos as $periodo)
                    <tr>
                        <td>{{ $periodo->nombre }}</td>
                        <td>{{ $periodo->inicio }}</td>
                        <td>{{ $periodo->fin }}</td>
                        <td>{{ $periodo->anioLectivo->anio }}</td>
                        <td>
                            <a href="{{ route('periodo.edit', $periodo) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('periodo.destroy', $periodo) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('¿Eliminar este periodo?')" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
