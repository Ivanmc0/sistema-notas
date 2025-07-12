<div class="modal fade" id="modalCrearEstudiante" tabindex="-1">
    <div class="modal-dialog">
        <form id="form-crear-estudiante">
            @csrf
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Nuevo Estudiante</h5></div>
                <div class="modal-body">
                    <input name="name" type="text" class="form-control mb-2" placeholder="Nombre completo" required>
                    <input name="email" type="email" class="form-control mb-2" placeholder="Email" required>
                    <input name="documento" type="text" class="form-control mb-2" placeholder="Documento" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $('#form-crear-estudiante').submit(function(e) {
        e.preventDefault();
        $.post('{{ route('api.estudiantes.store') }}', $(this).serialize(), function(estudiante) {
            $('#estudiante_id').append(new Option(estudiante.name, estudiante.id, true, true));
            $('#modalCrearEstudiante').modal('hide');
            $('#form-crear-estudiante')[0].reset();
        }).fail(function(xhr) {
            alert('Error al crear estudiante');
        });
    });
</script>
@endpush
