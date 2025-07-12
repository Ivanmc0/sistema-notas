@extends('layouts.admin')

@section('title', 'Años Lectivos')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Años Lectivos</h3>
        <a href="{{ route('anio.create') }}" class="btn btn-primary float-right">Nuevo Año</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">N°</th>
                    <th  class="text-center">Año</th>
                    <th  class="text-center" style="width: 100px;">Estado</th>
                    <th class="text-center" style="width: 300px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($anios as $anio)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $anio->anio }}</td>
                        <td>
                            @if($anio->activo)
                                <span class="badge badge-success">Activo</span>
                            @else
                                <span class="badge badge-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('anio.edit', $anio) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('anio.destroy', $anio) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('¿Deseas eliminar este año?')" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
