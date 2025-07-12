@extends('layouts.admin')

@section('title', 'Grados')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Grados</h3>
        <a href="{{ route('grado.create') }}" class="btn btn-primary float-right">Nuevo Grado</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">N°</th>
                    <th  class="text-center">Nombre</th>
                    <th class="text-center" style="width: 300px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grados as $grado)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $grado->nombre }}</td>
                        <td>
                            <a href="{{ route('grado.edit', $grado) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('grado.destroy', $grado) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('¿Eliminar este grado?')" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
