@extends('layouts.admin')

@section('title', 'Registro de Notas')

@section('content')
<div class="card">
    <div class="card-header"><h5>Registro de Notas</h5></div>
    <div class="card-body">

        {{-- Año lectivo --}}
        <div class="form-group">
            <label for="anio_lectivo_id">Año lectivo</label>
            <select id="anio_lectivo_id" class="form-control">
                <option value="">Seleccione un año</option>
                @foreach($anios as $anio)
                    <option value="{{ $anio->id }}">{{ $anio->anio }}</option>
                @endforeach
            </select>
        </div>

        {{-- Curso (cargado por AJAX) --}}
        <div class="form-group">
            <label for="curso_id">Curso</label>
            <select id="curso_id" class="form-control" disabled>
                <option value="">Seleccione un curso</option>
            </select>
        </div>

        {{-- Materia (asignación) --}}
        <div class="form-group">
            <label for="asignacion_id">Materia</label>
            <select id="asignacion_id" class="form-control" disabled>
                <option value="">Seleccione una materia</option>
            </select>
        </div>

        <form action="{{ route('nota.registro') }}" method="GET" id="form-nota-navegar">
            <input type="hidden" name="curso_id" id="form_curso_id">
            <input type="hidden" name="asignacion_id" id="form_asignacion_id">
            <button class="btn btn-primary mt-3" id="btn-continuar" disabled>Continuar</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#anio_lectivo_id').on('change', function () {
            const anioId = $(this).val();
            $('#curso_id').prop('disabled', true).html('<option value="">Cargando...</option>');

            if (anioId) {
                $.get(`/api/cursos/${anioId}`, function (data) {
                    let options = '<option value="">Seleccione un curso</option>';
                    data.forEach(curso => {
                        options += `<option value="${curso.id}">${curso.grado.nombre} - ${curso.seccion}</option>`;
                    });
                    $('#curso_id').html(options).prop('disabled', false);
                });
            } else {
                $('#curso_id').html('<option value="">Seleccione un curso</option>');
            }
        });

        // Cuando seleccionan un curso, cargar materias (asignaciones) para ese curso y docente actual
        $('#curso_id').on('change', function () {
            const cursoId = $(this).val();
            $('#asignacion_id').prop('disabled', true).html('<option value="">Cargando...</option>');

            if (cursoId) {
                $.get(`/api/asignaciones/${cursoId}`, function (data) {
                    let options = '<option value="">Seleccione una materia</option>';
                    data.forEach(asignacion => {
                        options += `<option value="${asignacion.id}">${asignacion.materia.nombre}</option>`;
                    });
                    $('#asignacion_id').html(options).prop('disabled', false);
                });
            } else {
                $('#asignacion_id').html('<option value="">Seleccione una materia</option>');
            }
        });

        $('#asignacion_id').on('change', function () {
            const asignacionId = $(this).val();
            $('#form_curso_id').val($('#curso_id').val());
            $('#form_asignacion_id').val(asignacionId);
            $('#btn-continuar').prop('disabled', !asignacionId);
        });
    });

</script>
@endsection

