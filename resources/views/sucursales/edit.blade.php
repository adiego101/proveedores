<!-- Modal -->
@if ($mode != 'show')

<form id="editformSucursal">
    @endif
    @csrf
    <div class="modal fade" id="editarSucursal" tabindex="-1" role="dialog" aria-labelledby="modalEditarSucursal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if ($mode != 'show')
                    <h1 class="modal-title" id="modalEditarSucursal">Editar Sucursal</h1>
                    @else
                    <h1 class="modal-title" id="modalEditarSucursal">Sucursal</h1>
                    @endif
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="respuesta">

                    </div>
                </div>
                <div class="modal-footer">
                    @if ($mode != 'show')
                        <button type="submit" class="btn btn-success">Guardar</button>

                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                        @else
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>

                        @endif
                </div>
            </div>
        </div>
    </div>
    @if ($mode != 'show')

</form>

@endif
