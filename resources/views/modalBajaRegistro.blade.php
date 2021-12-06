<!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Contenido del Modal-->
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Dar de baja</h1>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            <div class="modal-body">
                <p>¿Está seguro que desea dar de baja la empresa?</p>
                <p>Esta operación <b>NO</b> podrá deshacerse.</p>
            </div>
            <div class="modal-footer">
                {!! Form::open(['method' => 'GET','route' => ['baja', 1],'style'=>'display:inline']) !!}
                {!! Form::submit('Dar de Baja', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
