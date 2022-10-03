<div class="modal fade" id="edit_persona" role="dialog" aria-labelledby="editPersonaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPersonaModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ui-front">
          @include('personas.form')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger btn_cancel_modal" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="update_persona">Guardar</button>
      </div>
    </div>
  </div>
</div>

@push('js')
  <script>
    $(document).ready(function(){
      applyInputMaskDni($("#dni_x_{{$mode}}"), '0.000.000');
      $("#dni_x_{{$mode}}").blur(function(){
        if($(this).val()!='')
            validarDniModal($(this).data('mode'), $(this));
        else
            ocultarError($(this), '#small-dni-x-{{$mode}}');
      });
          
      $("#apellido_x_{{$mode}}").keyup(function(){
          ocultarError($(this), '#small-apellido-x-{{$mode}}');
      });

      $("#nombre_x_{{$mode}}").keyup(function(){
          ocultarError($(this), '#small-nombre-x-{{$mode}}');
      });

      $("#cargo_x_{{$mode}}").keyup(function(){
          ocultarError($(this), '#small-cargo-x-{{$mode}}');
      });
    })
  </script>
@endpush