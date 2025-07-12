@extends('layouts.admin')

@section('title', 'Detalle de Matrícula')

@section('content')

<style>
    .nota-alta { background-color: #d4edda; }     /* verde claro */
    .nota-media { background-color: #fff3cd; }    /* amarillo */
    .nota-baja  { background-color: #f8d7da; }     /* rojo claro */
    .nota-error { border: 2px solid red !important; }
</style>

<form action="{{ route('nota.store') }}" method="POST">
    @csrf
    <input type="hidden" name="periodo_id" value="{{ $periodoActivo->id }}">
    <input type="hidden" name="asignacion_id" value="{{ $asignacion->id }}">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Estudiante</th>
                @foreach($periodos as $p)
                    <th>{{ $p->nombre }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($estudiantes as $estudiante)
                <tr>
                    <td>{{ $estudiante->name }}</td>
                    @foreach($periodos as $p)
                        <td>
                            @php
                                $nota = $notas->firstWhere(fn($n) => $n->estudiante_id === $estudiante->id && $n->periodo_id === $p->id);
                            @endphp
                            <input type="number" name="notas[{{ $estudiante->id }}][{{ $p->id }}]"
                                value="{{ $nota->valor ?? '' }}"
                                class="form-control"
                                step="0.01"
                                min="0" max="5"
                                {{ $p->id !== $periodoActivo->id ? 'readonly' : '' }}>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <button class="btn btn-primary">Guardar notas del periodo {{ $periodoActivo->nombre }}</button>
</form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            function validarNotas() {
                $('input[type=number]').each(function () {
                    const val = parseFloat($(this).val());
                    $(this).removeClass('nota-alta nota-media nota-baja nota-error');

                    if ($(this).is('[readonly]') || $(this).val() === '') return;

                    if (isNaN(val) || val < 0 || val > 5) {
                        $(this).addClass('nota-error');
                    } else if (val >= 4) {
                        $(this).addClass('nota-alta');
                    } else if (val >= 3) {
                        $(this).addClass('nota-media');
                    } else {
                        $(this).addClass('nota-baja');
                    }
                });
            }

            // Validar al escribir
            $(document).on('input', 'input[type=number]', validarNotas);

            // Validar al cargar
            validarNotas();
        });
    </script>
@endsection