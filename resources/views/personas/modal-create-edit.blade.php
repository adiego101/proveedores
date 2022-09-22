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
    $("#apellido_{{$tipo_persona}}_{{$mode}}").keyup(validarExisteDatosPersona);

    $("#nombre_{{$tipo_persona}}_{{$mode}}").keyup(validarExisteDatosPersona);

    $("#dni_{{$tipo_persona}}_{{$mode}}").change(validarExisteDatosPersona);

    $("#cargo_{{$tipo_persona}}_{{$mode}}").keyup(validarExisteDatosPersona);

    function validarExisteDatosPersona()
    {
      let tipo_persona = @json($tipo_persona);
      let mode = @json($mode);

      console.log("#si pasa por ak tipo persona ="+tipo_persona+" mode = "+mode);
      if($('#apellido_{{$tipo_persona}}_{{$mode}}').val()=='')
      {
      mostrarError('#apellido_{{$tipo_persona}}_{{$mode}}', '#small-apellido-{{$tipo_persona}}-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El APELLIDO de la persona <strong>no</strong> puede quedar vacío.</div>');
      if($("#dni_{{$tipo_persona}}_{{$mode}}").val()=='')
      {
          mostrarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El DNI de la persona <strong>no</strong> puede quedar vacío.</div>');
          if($("#nombre_{{$tipo_persona}}_{{$mode}}").val()=='')
          {
            ocultarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}-{{$mode}}');
            ocultarError('#apellido_{{$tipo_persona}}_{{$mode}}', '#small-apellido-{{$tipo_persona}}-{{$mode}}');
            ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-{{$mode}}');
            return true;
          }
          else
          {
            ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-{{$mode}}');
            return true;
          }
      }
      else
      {
          
          ocultarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}-{{$mode}}');
          validarDni($('#dni_{{$tipo_persona}}_{{$mode}}'));
          if($("#nombre_{{$tipo_persona}}_{{$mode}}").val()=='')
          {
          mostrarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE de la persona <strong>no</strong> puede quedar vacío.</div>');
          return false;
          }
          else
          {
          ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-{{$mode}}');
          return true;
          }
      }
      }
      else
      {
      ocultarError('#apellido_{{$tipo_persona}}_{{$mode}}', '#small-apellido-{{$tipo_persona}}-{{$mode}}');
          if($("#dni_{{$tipo_persona}}_{{$mode}}").val()=='')
          {
              mostrarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El DNI de la persona <strong>no</strong> puede quedar vacío.</div>');
              if($("#nombre_{{$tipo_persona}}_{{$mode}}").val()=='')
              {
              mostrarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE de la persona <strong>no</strong> puede quedar vacío.</div>');
              return false;
              }
              else
              {
              ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-{{$mode}}');
              return true;
              }
          }
          else
          {
              ocultarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}-{{$mode}}');
              validarDni($('#dni_{{$tipo_persona}}_{{$mode}}'));
              if($("#nombre_{{$tipo_persona}}_{{$mode}}").val()=='')
              {
              mostrarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE de la persona <strong>no</strong> puede quedar vacío.</div>');
              return false;
              }
              else
              {
              ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-{{$mode}}');
              return true;
              }
          }
      }
    }
  </script>
@endpush