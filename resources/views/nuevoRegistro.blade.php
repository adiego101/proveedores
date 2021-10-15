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
        @include('altaRegistro.datosGenerales')
        @include('altaRegistro.sucursales')
        @include('altaRegistro.infoImpositiva')
        @include('altaRegistro.actividad')
        @include('altaRegistro.valorAgregado')
        @include('altaRegistro.personalOcupado')
        @include('altaRegistro.pagos')
        @include('altaRegistro.otrosDatos')

        <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-end">    
                <div class="btn-group">
                    <button type="submit" name="boton" value="ver" class="btn btn-outline-primary"><i class="fas fa-info-circle"></i> {{ 'Siguiente' }} </button>
                            
                </div>
            </div>-->
    </form> 
@yield('datos')
    
@endsection
