@extends('layouts.admin')

@section('title', 'Listado de Grados')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Grados</h3>
        <a href="{{ route('grados.create') }}" class="btn btn-primary">Nuevo Grado</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grados as $grado)
                <tr>
                    <td>{{ $grado->id }}</td>
                    <td>{{ $grado->nombre }}</td>
                    <td>
                        <a href="{{ route('grados.edit', $grado) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('grados.destroy', $grado) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este grado?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
