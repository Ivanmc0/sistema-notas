<div class="text-center mb-4">
    <img src="https://api.dicebear.com/7.x/shapes/svg?seed=school" alt="Logo" style="height: 60px;">
    <h4 class="mt-2 mb-0">Institución Educativa Liceo Comunitario Nueva Generación</h4>
    <small>Reporte de Notas por Estudiante</small>
</div>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Documento</th>
            <th>Grado</th>
            <th>Curso</th>
            <th>Materias</th>
            <th>Notas</th>
        </tr>
    </thead>
    <tbody>
        @forelse($estudiantes as $estudiante)
            <tr>
                <td>{{ $estudiante->name }}</td>
                <td>{{ $estudiante->documento ?? '-' }}</td>
                <td>
                    @php
                        $matricula = $estudiante->matriculas->first();
                    @endphp
                    {{ $matricula->curso->grado->nombre ?? '-' }}
                </td>
                <td>{{ $matricula->curso->seccion ?? '-' }}</td>
                <td>
                    @foreach($estudiante->notas as $nota)
                        <div>{{ $nota->materia->nombre ?? '-' }}</div>
                    @endforeach
                </td>
                <td>
                    @foreach($estudiante->notas as $nota)
                        <div>{{ $nota->valor ?? '-' }}</div>
                    @endforeach
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No se encontraron estudiantes con los filtros seleccionados.</td>
            </tr>
        @endforelse
    </tbody>
</table> 