<fieldset>

    <h1>Datos generales</h1><br>

    <label for="razon_social">Razón social: <sup>*</sup></label><br>
    <input type="text" class="form-control" placeholder="Ingrese la razón social" aria-describedby="basic-addon1" id="razon_social" name="razon_social"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->razon_social) ? $proveedor->razon_social : '' }}" maxlength="50" autofocus required>
<small class="small" id="small-razon_social"></small>
<br>

    <label for="nombre_fantasia">Nombre de fantasía: <sup>*</sup></label><br>
    <input type="text" class="form-control" placeholder="Ingrese el nombre de fantasía" aria-describedby="basic-addon1" id="nombre_fantasia" name="nombre_fantasia"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" maxlength="50" required>
<small class="small" id="small-nombre_fantasia"></small>
<br>

    <label for="cuit">CUIT: <sup>*</sup></label><br>
    <input type="text" class="form-control" placeholder="Ingrese el número de cuit de la empresa (sin guiones medios)" aria-describedby="basic-addon1" id="cuit" name="cuit"
        @if ( $mode == "show") readonly @endif
value=@if(isset($proveedor->cuit))"{{$proveedor->cuit}}"@elseif(isset($cuit))"{{$cuit}}"@endif maxlength="13" pattern="^([0-9]{2})-([0-9]{8})-([0-9]{1})$" required>
    <small class="small" id="small-cuit-vacio"></small>
    <small class="small" id="small-cuit-mal-formato"></small>
    <br>

    <label for="observaciones">Observaciones:</label><br>
    <textarea id="observaciones"   @if ( $mode == "show") readonly @endif name="observaciones" class="form-control" placeholder="Ingrese las observaciones que considere necesarias" maxlength="200">{{ isset($proveedor->observaciones) ? $proveedor->observaciones : '' }}</textarea>
    <br>
    <hr>
    <br>
    <h1>Representante Legal</h1><br>
    <div class="ui-widget">
        <label for="dni_legal">DNI:</label><br>
            <input type="text" class="form-control limpiar" placeholder="Ingrese el dni del representante legal" @if ( $mode == "show") readonly @endif
                value="{{ isset($representante->dni_persona) ? $representante->dni_persona : '' }}" aria-describedby="basic-addon1" id="dni_legal" name="dni_legal" maxlength="10">
            <small class="small" id="small-dni"></small>
    </div>
    <br>

    <label for="apellido_persona">Apellido:</label><br>
    <input type="text" @if ( $mode == "show") readonly @endif value="{{ isset($representante->apellido_persona) ? $representante->apellido_persona : '' }}" class="form-control limpiar" placeholder="Ingrese el apellido del representante legal" aria-describedby="basic-addon1" id="apellido_persona" name="apellido_persona" maxlength="50">
    <small class="small" id="small-apellido"></small><br>


    <label for="nombre_persona">Nombre:</label><br>
    <input type="text" @if ( $mode == "show") readonly @endif class="form-control limpiar" value="{{ isset($representante->nombre_persona) ? $representante->nombre_persona : '' }}" placeholder="Ingrese el nombre completo del representante legal" aria-describedby="basic-addon1" id="nombre_persona" name="nombre_persona" maxlength="50">
    <small class="small" id="small-nombre"></small><br>

    <br>
    @if($mode=='create')
        <input type="button" id="next_datos" name="next" class="next btn btn-info" value="Siguiente"/>
    @else
        <div class="row navbuttons">
            <div class="col-6 col-sm-auto" id="btnNext">
                <a class="btn btn-primary btnNext">Siguiente</a>
            </div>
        </div>
    @endif
</fieldset>


@push('js')

<script type="text/javascript">
      $(document).ready(function(){
        $('#razon_social').keyup(validar_razon_social);
        $('#nombre_fantasia').keyup(validar_nombre_fantasia);
        $('#cuit').keyup(validar_cuit);
        $("#apellido_persona").keyup(validarExisteDatosRepresentante);
        $("#nombre_persona").keyup(validarExisteDatosRepresentante);
        $("#dni_legal").keyup(validarExisteDatosRepresentante);
        $( "#dni_legal" ).autocomplete({
          source: function( request, response ) {
            $.ajax( {
              url: "{{url('responsable/')}}/"+request.term,
              dataType: "json",
              success: function( data ) {
                response( data );
              }
            } );
          },
          minLength: 2,
          select: function( event, ui ) {
            $("#apellido_persona").val(ui.item.apellido_persona);
            $("#nombre_persona").val(ui.item.nombre_persona);
            ocultarError('#dni_legal', '#small-dni');
            ocultarError('#dni_legal', '#small-dni-legal');
            ocultarError('#apellido_persona', '#small-apellido');
            ocultarError('#apellido_persona', '#small-apellido-legal');
            ocultarError('#nombre_persona', '#small-nombre');
            ocultarError('#nombre_persona', '#small-nombre-legal');
          }
        } );
      });    

    function validarExisteDatosRepresentante()
    {
        if($('#apellido_persona').val()=='')
        {
          mostrarError('#apellido_persona', '#small-apellido', '<div class="alert alert-danger mt-3 pt-1">El APELLIDO del representante <strong>no</strong> puede quedar vacío.</div>');
          mostrarError('#apellido_persona', '#small-apellido-legal', '<div class="alert alert-danger mt-3 pt-1">El APELLIDO del representante <strong>no</strong> puede quedar vacío.</div>');
          if($("#dni_legal").val()=='')
          {
            mostrarError('#dni_legal', '#small-dni', '<div class="alert alert-danger mt-3 pt-1">El DNI del representante <strong>no</strong> puede quedar vacío.</div>');
            mostrarError('#dni_legal', '#small-dni-legal', '<div class="alert alert-danger mt-3 pt-1">El DNI del representante <strong>no</strong> puede quedar vacío.</div>');
            if($("#nombre_persona").val()=='')
            {
              ocultarError('#dni_legal', '#small-dni');
              ocultarError('#dni_legal', '#small-dni-legal');
              ocultarError('#apellido_persona', '#small-apellido');
              ocultarError('#apellido_persona', '#small-apellido-legal');
              ocultarError('#nombre_persona', '#small-nombre');
              ocultarError('#nombre_persona', '#small-nombre-legal');
              return true;
            }
            else
            {
              ocultarError('#nombre_persona', '#small-nombre');
              ocultarError('#nombre_persona', '#small-nombre-legal');
              return true;
            }
          }
          else
          {
            
            ocultarError('#dni_legal', '#small-dni');
            ocultarError('#dni_legal', '#small-dni-legal');
            validarDni();
            if($("#nombre_persona").val()=='')
            {
              mostrarError('#nombre_persona', '#small-nombre', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del representante <strong>no</strong> puede quedar vacío.</div>');
              mostrarError('#nombre_persona', '#small-nombre-legal', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del representante <strong>no</strong> puede quedar vacío.</div>');
              return false;
            }
            else
            {
              ocultarError('#nombre_persona', '#small-nombre');
              ocultarError('#nombre_persona', '#small-nombre-legal');
              return true;
            }
          }
        }
        else
        {
          ocultarError('#apellido_persona', '#small-apellido');
          ocultarError('#apellido_persona', '#small-apellido-legal');
          if($("#dni_legal").val()=='')
          {
            mostrarError('#dni_legal', '#small-dni', '<div class="alert alert-danger mt-3 pt-1">El DNI del representante <strong>no</strong> puede quedar vacío.</div>');
            mostrarError('#dni_legal', '#small-dni-legal', '<div class="alert alert-danger mt-3 pt-1">El DNI del representante <strong>no</strong> puede quedar vacío.</div>');
            if($("#nombre_persona").val()=='')
            {
              mostrarError('#nombre_persona', '#small-nombre', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del representante <strong>no</strong> puede quedar vacío.</div>');
              mostrarError('#nombre_persona', '#small-nombre-legal', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del representante <strong>no</strong> puede quedar vacío.</div>');
              return false;
            }
            else
            {
              ocultarError('#nombre_persona', '#small-nombre');
              ocultarError('#nombre_persona', '#small-nombre-legal');
              return true;
            }
          }
          else
          {
            ocultarError('#dni_legal', '#small-dni');
            ocultarError('#dni_legal', '#small-dni-legal');
            validarDni();
            if($("#nombre_persona").val()=='')
            {
              mostrarError('#nombre_persona', '#small-nombre', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del representante <strong>no</strong> puede quedar vacío.</div>');
              mostrarError('#nombre_persona', '#small-nombre-legal', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del representante <strong>no</strong> puede quedar vacío.</div>');
              return false;
            }
            else
            {
              ocultarError('#nombre_persona', '#small-nombre');
              ocultarError('#nombre_persona', '#small-nombre-legal');
              return true;
            }
          }
        }
    }
    
    </script>

@endpush
