@extends('layouts.admin')

@section('title', 'Reportes')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-file-alt"></i> Generar Reportes</h3>
    </div>
    <div class="card-body">
        <form id="filtros-reportes" class="row g-3">
            <div class="col-md-3">
                <label for="tipo_reporte" class="form-label">Tipo de Reporte</label>
                <select id="tipo_reporte" name="tipo_reporte" class="form-control">
                    <option value="">Seleccione...</option>
                    <option value="estudiante">Notas por Estudiante</option>
                    <option value="curso">Notas por Curso</option>
                    <option value="materia">Notas por Materia</option>
                    <option value="grado">Resumen por Grado</option>
                    <option value="general">Reporte General</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="anio_lectivo" class="form-label">Año lectivo</label>
                <select id="anio_lectivo" name="anio_lectivo" class="form-control">
                    <option value="">Todos</option>
                    @foreach($anios as $anio)
                        <option value="{{ $anio->id }}">{{ $anio->anio }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="grado" class="form-label">Grado</label>
                <select id="grado" name="grado" class="form-control">
                    <option value="">Todos</option>
                    @foreach($grados as $grado)
                        <option value="{{ $grado->id }}">{{ $grado->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="curso" class="form-label">Curso</label>
                <select id="curso" name="curso" class="form-control">
                    <option value="">Todos</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}">{{ $curso->grado->nombre ?? '' }} - {{ $curso->seccion }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="materia" class="form-label">Materia</label>
                <select id="materia" name="materia" class="form-control">
                    <option value="">Todas</option>
                    @foreach($materias as $materia)
                        <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mt-2">
                <label for="busqueda" class="form-label">Buscar estudiante</label>
                <input type="text" id="busqueda" name="busqueda" class="form-control" placeholder="Nombre o documento">
            </div>
            <div class="col-12 mt-4">
                <button type="button" class="btn btn-primary me-2">Vista previa</button>
                <button type="button" class="btn btn-success me-2" disabled>Descargar PDF</button>
                <button type="button" class="btn btn-info" disabled>Descargar Excel</button>
            </div>
        </form>
        <hr>
        <div id="preview-reporte" class="mt-4">
            <!-- Aquí se mostrará la vista previa del reporte -->
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const anioSelect = document.getElementById('anio_lectivo');
    const gradoSelect = document.getElementById('grado');
    const cursoSelect = document.getElementById('curso');
    const materiaSelect = document.getElementById('materia');

    // Cuando cambia el año lectivo
    anioSelect.addEventListener('change', function() {
        const anioId = this.value;
        // Grados
        fetch(`/api/grados/${anioId}`)
            .then(res => res.json())
            .then(data => {
                gradoSelect.innerHTML = '<option value="">Todos</option>';
                data.forEach(grado => {
                    gradoSelect.innerHTML += `<option value="${grado.id}">${grado.nombre}</option>`;
                });
            });
        // Cursos
        fetch(`/api/cursos/${anioId}`)
            .then(res => res.json())
            .then(data => {
                cursoSelect.innerHTML = '<option value="">Todos</option>';
                data.forEach(curso => {
                    cursoSelect.innerHTML += `<option value="${curso.id}">${curso.grado?.nombre ?? ''} - ${curso.seccion}</option>`;
                });
            });
        // Limpiar materias
        materiaSelect.innerHTML = '<option value="">Todas</option>';
    });

    // Cuando cambia el grado
    gradoSelect.addEventListener('change', function() {
        const anioId = anioSelect.value;
        const gradoId = this.value;
        if (!anioId) return;
        fetch(`/api/cursos/${anioId}/${gradoId}`)
            .then(res => res.json())
            .then(data => {
                cursoSelect.innerHTML = '<option value="">Todos</option>';
                data.forEach(curso => {
                    cursoSelect.innerHTML += `<option value="${curso.id}">${curso.grado?.nombre ?? ''} - ${curso.seccion}</option>`;
                });
            });
        // Limpiar materias
        materiaSelect.innerHTML = '<option value="">Todas</option>';
    });

    // Cuando cambia el curso
    cursoSelect.addEventListener('change', function() {
        const cursoId = this.value;
        if (!cursoId) {
            materiaSelect.innerHTML = '<option value="">Todas</option>';
            return;
        }
        fetch(`/api/materias/${cursoId}`)
            .then(res => res.json())
            .then(data => {
                materiaSelect.innerHTML = '<option value="">Todas</option>';
                data.forEach(materia => {
                    materiaSelect.innerHTML += `<option value="${materia.id}">${materia.nombre}</option>`;
                });
            });
    });
});

// Vista previa de Notas por Estudiante
const btnVistaPrevia = document.querySelector('button.btn-primary');
btnVistaPrevia.addEventListener('click', function(e) {
    e.preventDefault();
    const tipoReporte = document.getElementById('tipo_reporte').value;
    if (tipoReporte !== 'estudiante') return;
    const data = new FormData(document.getElementById('filtros-reportes'));
    fetch('/admin/reportes/preview-estudiante', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: data
    })
    .then(res => res.json())
    .then(res => {
        document.getElementById('preview-reporte').innerHTML = res.html;
    });
});
</script>
@endpush
@endsection 