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
          <input id="numero_fila_persona" name="numero_fila_persona" type="hidden">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn_edit_modal">Editar</button>
        <button type="button" class="btn btn-secondary btn_cancel_modal" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

@push('js')
  <script>
    $("#apellido_{{$tipo_persona}}_{{$mode}}").keyup(validarExisteDatosPersona);

    $("#nombre_{{$tipo_persona}}_{{$mode}}").keyup(validarExisteDatosPersona);

    $("#dni_{{$tipo_persona}}_{{$mode}}").keyup(validarExisteDatosPersona);

    $("#cargo_{{$tipo_persona}}_{{$mode}}").keyup(validarExisteDatosPersona);

    function validarExisteDatosPersona()
    {
      if($('#apellido_{{$tipo_persona}}_{{$mode}}').val()=='')
      {
      mostrarError('#apellido_{{$tipo_persona}}_{{$mode}}', '#small-apellido-{{$tipo_persona}}', '<div class="alert alert-danger mt-3 pt-1">El APELLIDO de la persona <strong>no</strong> puede quedar vacío.</div>');
      if($("#dni_{{$tipo_persona}}_{{$mode}}").val()=='')
      {
          mostrarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}', '<div class="alert alert-danger mt-3 pt-1">El DNI de la persona <strong>no</strong> puede quedar vacío.</div>');
          if($("#nombre_{{$tipo_persona}}_{{$mode}}").val()=='')
          {
          ocultarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}');
          ocultarError('#apellido_{{$tipo_persona}}_{{$mode}}', '#small-apellido-{{$tipo_persona}}');
          ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}');
          if($('#cargo_{{$tipo_persona}}_{{$mode}}').val()=='')
            {
                mostrarError('#cargo_{{$tipo_persona}}_{{$mode}}', '#small-cargo-{{$tipo_persona}}', '<div class="alert alert-danger mt-3 pt-1">El CARGO de la persona <strong>no</strong> puede quedar vacío.</div>');
            }
            else
            {
                ocultarError('#cargo_{{$tipo_persona}}_{{$mode}}', '#small-cargo-{{$tipo_persona}}');
                return true;
            }
          
          }
          else
          {
          ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}');
          return true;
          }
      }
      else
      {
          
          ocultarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}');
          validarDni($('#dni_{{$tipo_persona}}_{{$mode}}'));
          if($("#nombre_{{$tipo_persona}}_{{$mode}}").val()=='')
          {
          mostrarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE de la persona <strong>no</strong> puede quedar vacío.</div>');
          return false;
          }
          else
          {
          ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}');
          return true;
          }
      }
      }
      else
      {
      ocultarError('#apellido_{{$tipo_persona}}_{{$mode}}', '#small-apellido-{{$tipo_persona}}');
          if($("#dni_{{$tipo_persona}}_{{$mode}}").val()=='')
          {
              mostrarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}', '<div class="alert alert-danger mt-3 pt-1">El DNI de la persona <strong>no</strong> puede quedar vacío.</div>');
              if($("#nombre_{{$tipo_persona}}_{{$mode}}").val()=='')
              {
              mostrarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE de la persona <strong>no</strong> puede quedar vacío.</div>');
              return false;
              }
              else
              {
              ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}');
              return true;
              }
          }
          else
          {
              ocultarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}');
              validarDni($('#dni_{{$tipo_persona}}_{{$mode}}'));
              if($("#nombre_{{$tipo_persona}}_{{$mode}}").val()=='')
              {
              mostrarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE de la persona <strong>no</strong> puede quedar vacío.</div>');
              return false;
              }
              else
              {
              ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}');
              return true;
              }
          }
      }
    }

  </script>
@endpush
