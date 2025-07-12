<div class="modal fade" id="modalCrearAcudiente" tabindex="-1">
    <div class="modal-dialog">
        <form id="form-crear-acudiente">
            @csrf
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Nuevo Acudiente</h5></div>
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
    $('#form-crear-acudiente').submit(function(e) {
        e.preventDefault();
        $.post('{{ route('api.acudientes.store') }}', $(this).serialize(), function(acudiente) {
            $('#acudiente_id').append(new Option(acudiente.name, acudiente.id, true, true));
            $('#modalCrearAcudiente').modal('hide');
            $('#form-crear-acudiente')[0].reset();
        }).fail(function(xhr) {
            alert('Error al crear acudiente');
        });
    });
</script>
@endpush