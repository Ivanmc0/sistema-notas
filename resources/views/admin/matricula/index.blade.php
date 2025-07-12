@extends('layouts.admin')

@section('title', 'Matrículas')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Listado de Matrículas</h3>
        <a href="{{ route('matricula.create') }}" class="btn btn-primary float-right">Nueva Matrícula</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Estudiante</th>
                    <th class="text-center">Curso</th>
                    <th class="text-center" style="width: 300px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($matriculas as $matricula)
                    <tr>
                        <td>{{ $matricula->estudiante->name }}</td>
                        <td>
                            {{ $matricula->curso->grado->nombre ?? '---' }} - {{ $matricula->curso->seccion }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('matricula.show', $matricula) }}" class="btn btn-info btn-sm">
                                Ver
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
