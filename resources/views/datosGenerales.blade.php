@extends('layouts')

@section('content2')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
  var current = 1,current_step,next_step,steps;
  steps = $("fieldset").length;
  $(".next").click(function(){
    current_step = $(this).parent();
    next_step = $(this).parent().next();
    next_step.show();
    current_step.hide();
    setProgressBar(++current);
    $(window).scrollTop(0);
  });
  $(".previous").click(function(){
    current_step = $(this).parent();
    next_step = $(this).parent().prev();
    next_step.show();
    current_step.hide();
    setProgressBar(--current);
    $(window).scrollTop(0);
  });
  setProgressBar(current);
  // Change progress bar action
  function setProgressBar(curStep){
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar")
      .css("width",percent+"%")
      .html(percent+"%");   
  }
});
</script>

<style>

#regiration_form fieldset:not(:first-of-type) {
    display: none;
  }
</style>

  
    <div class="progress">
        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <br>
    <div class="alert alert-info" role="alert">
        Complete los campos que se presentan continuación
        y presione el botón <b>Siguiente</b>, para continuar la carga de datos.
    </div>

    <form id="regiration_form" action="">
        <fieldset>
            <p>Datos del Domicilio real</p>

            <label for="domicilio-real">Domicilio:</label><br>
            <input type="text" class="form-control" placeholder="ingrese su domicilio real" aria-describedby="basic-addon1" id="domicilio-real" name="domicilio-real" required autofocus><br>

            <!--En este caso, se deben recuperar las localidades de la BD -->
            <label for="localidad-real">Localidad:</label><br>
            <select class="form-control" aria-describedby="basic-addon1" id="localidad-real" name="localidad-real">
                <option selected value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
            <br>

            <label for="provincia-real">Provincia:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="provincia-real" name="provincia-real" required disabled><br>

            <label for="pais-real">Pais:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="pais-real" name="pais-real" required disabled><br>

            <label for="cp-real">Código Postal:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="cp-real" name="cp-real" required disabled><br>


            <label for="telefono-real">Teléfono:</label><br>
            <input type="number" class="form-control" placeholder="ingrese su teléfono" aria-describedby="basic-addon1" id="telefono-real" name="telefono-real" required><br>

            <label for="fax-real">Fax:</label><br>
            <input type="text" class="form-control" placeholder="ingrese su fax" aria-describedby="basic-addon1" id="fax-real" name="fax-real" required><br>

            <label for="email-real">Correo electrónico:</label><br>
            <input type="email" class="form-control" placeholder="ingrese su correo electrónico" aria-describedby="basic-addon1" id="email-real" name="email-real" required><br>
                        
            <label for="web-real">Página web:</label><br>
            <input type="text" class="form-control" placeholder="ingrese su página web" aria-describedby="basic-addon1" id="web-real" name="web-real" required><br>

            <input type="button" name="next" class="next btn btn-info" value="Siguiente" />            
        </fieldset>
                    
        <fieldset>                  
            <p>Datos del Domicilio legal</p>

            <label for="domicilio-legal">Domicilio:</label><br>
            <input type="text" class="form-control" placeholder="ingrese su domicilio legal" aria-describedby="basic-addon1" id="domicilio-legal" name="domicilio-legal" required><br>

            <!--En este caso, se deben recuperar las localidades de la BD -->
            <label for="localidad-legal">Localidad:</label><br>
            <select class="form-control" aria-describedby="basic-addon1" id="localidad-legal" name="localidad-legal">
                <option selected value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
            <br>

            <label for="provincia-legal">Provincia:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="provincia-legal" name="provincia-legal" required disabled><br>

            <label for="pais-legal">Pais:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="pais-legal" name="pais-legal" required disabled><br>

            <label for="cp-legal">Código Postal:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="cp-legal" name="cp-legal" required disabled><br>


            <label for="telefono-legal">Teléfono:</label><br>
            <input type="number" class="form-control" placeholder="ingrese su teléfono" aria-describedby="basic-addon1" id="telefono-legal" name="telefono-legal" required><br>

            <label for="fax-legal">Fax:</label><br>
            <input type="text" class="form-control" placeholder="ingrese su fax" aria-describedby="basic-addon1" id="fax-legal" name="fax-legal" required><br>

            <label for="email-legal">Correo electrónico:</label><br>
            <input type="email" class="form-control" placeholder="ingrese su correo electrónico" aria-describedby="basic-addon1" id="email-legal" name="email-legal" required><br>
                        
            <label for="representante-legal">Representante:</label><br>
            <input type="text" class="form-control" placeholder="ingrese el nombre del representante legal" aria-describedby="basic-addon1" id="representante-legal" name="representante-legal" required><br>

            <label for="dni-legal">Dni:</label><br>
            <input type="number" class="form-control" placeholder="ingrese el dni del representante legal" aria-describedby="basic-addon1" id="dni-legal" name="dni-legal" required><br>

            <label for="observaciones">Observaciones:</label><br>
            <textarea id="observaciones" name="observaciones" rows="10" cols="101" placeholder="ingrese las observaciones que considere necesarias"></textarea>
            
            <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
            <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

        </fieldset>
        <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-end">    

                <div class="btn-group">
                    <button type="submit" name="boton" value="ver" class="btn btn-outline-primary"><i class="fas fa-info-circle"></i> {{ 'Siguiente' }} </button>
                            
                </div>
            </div>-->
    </form> 
@yield('datos')
    
@endsection
