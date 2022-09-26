<div class="modal fade" id="add_persona" role="dialog" aria-labelledby="addPersonaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPersonaModalLabel">Nueva Persona</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ui-front">
          @include('personas.form')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger btn_cancel_modal" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="store_persona">Guardar</button>
      </div>
    </div>
  </div>
</div>

@push('js')
  <script>
    $(document).ready(function(){
      applyInputMaskdni($("#dni_x_{{$mode}}"), '0.000.000');
      $("#dni_x_{{$mode}}").change(function(){
        if($(this).val()!='')
            validarDniModal('{{$mode}}', $(this));
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