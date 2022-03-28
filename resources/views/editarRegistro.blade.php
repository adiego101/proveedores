@extends('layouts')

@section('content2')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <nav>
        <ul class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <li class="nav-item">
                <a class=" nav-link @if(empty($tab)){{"active"}} @endif" id="datos-generales-tab" data-toggle="tab"
                    href="#datos-generales">Datos Generales</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link" id="domicilioReal-tab" data-toggle="tab"
                    href="#domicilioReal">Domicilio Real</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="domicilioLegal-tab" data-toggle="tab"
                    href="#domicilioLegal">Domicilio Legal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="domicilioFiscal-tab" data-toggle="tab"
                    href="#domicilioFiscal">Domicilio fiscal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($tab =="sucursal"){{"active"}} @endif" id="sucursales-tab" data-toggle="tab"
                    href="#sucursales">Sucursales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="infoImpositiva-tab" data-toggle="tab"
                    href="#infoImpositiva">Informacion Impositiva</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="ingresosbrutos-tab" data-toggle="tab"
                    href="#ingresosbrutos">Impuestos sobre ingresos brutos</a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if($tab =="actividad"){{"active"}} @endif" id="actividad-tab" data-toggle="tab"
                    href="#actividad">Actividad</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="valorAgregado-tab" data-toggle="tab"
                    href="#valorAgregado">Valor Agregado</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="personalOcupado-tab" data-toggle="tab"
                    href="#personalOcupado">Personal Ocupado</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($tab =="pago"){{"active"}} @endif" id="pagos-tab" data-toggle="tab" href="#pagos">Pagos</a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if($tab =="patente"){{"active"}} @endif " id="patente-tab" data-toggle="tab" href="#patente">Patente y Seguro</a>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="otrosDatos-tab" data-toggle="tab" href="#otrosDatos">Otros
                    Datos</a>
            </li>

        </ul>

        <br>

    </nav>

    <form id="edit_form" action="{{url('editarProveedor/'.$proveedor->id_proveedor)}}"  method="POST">
        @csrf

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade  @if(empty($tab)){{"show active"}} @endif" id="datos-generales" role="tabpanel"
                            aria-labelledby="nav-datos-generales-tab">
                           @include('editarRegistro.datosGenerales')
                        </div>
                        <div class="tab-pane fade" id="domicilioReal" role="tabpanel"
                            aria-labelledby="nav-domicilioReal-tab">
                            @include('editarRegistro.domicilioReal')
                        </div>
                        <div class="tab-pane fade" id="domicilioLegal" role="tabpanel"
                            aria-labelledby="nav-domicilioLegal-tab">
                            @include('editarRegistro.domicilioLegal')

                        </div>
                        <div class="tab-pane fade @if($tab =="sucursal"){{"show active"}} @endif" id="sucursales" role="tabpanel" aria-labelledby="nav-sucursales-tab">
                            @include('editarRegistro.sucursales')
                        </div>
                        <div class="tab-pane fade" id="infoImpositiva" role="tabpanel"
                            aria-labelledby="nav-infoImpositiva-tab">
                            @include('editarRegistro.infoImpositiva')
                        </div>
                        <div class="tab-pane fade" id="ingresosbrutos" role="tabpanel"
                            aria-labelledby="nav-ingresosbrutos-tab">
                            @include('editarRegistro.Impuestosingresosbrutos')
                        </div>
                        <div class="tab-pane fade" id="domicilioFiscal" role="tabpanel"
                            aria-labelledby="nav-domicilioFiscal.blade-tab">
                             @include('editarRegistro.domicilioFiscal')
                        </div>
                        <div class="tab-pane fade @if($tab =="actividad"){{"show active"}} @endif " id="actividad" role="tabpanel" aria-labelledby="nav-actividad-tab">
                            @include('editarRegistro.actividad')
                        </div>
                        <div class="tab-pane fade" id="valorAgregado" role="tabpanel"
                            aria-labelledby="nav-valorAgregado-tab">
                             @include('editarRegistro.valorAgregado')

                        </div>
                        <div class="tab-pane fade" id="personalOcupado" role="tabpanel"
                            aria-labelledby="nav-personalOcupado-tab">
                             @include('editarRegistro.personalOcupado')
                        </div>
                        <div class="tab-pane fade  @if($tab =="pago"){{"show active"}} @endif" id="pagos" role="tabpanel" aria-labelledby="nav-pagos-tab">
                            @include('editarRegistro.pagos')
                        </div>

                        <div class="tab-pane fade  @if($tab =="patente"){{"show active"}} @endif" id="patente" role="tabpanel" aria-labelledby="nav-patente-tab">
                            @include('editarRegistro.patenteSeguro')
                        </div>

                            <div class="tab-pane fade" id="otrosDatos" role="tabpanel"
                                aria-labelledby="nav-otrosDatos-tab">
                                @include('editarRegistro.otrosDatos') </div>
                        </div>



        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <div class="btn-group">
                <button type="submit" name="finalizar" class="btn btn-success"> {{ 'Finalizar' }} </button>
                <!--<a id="reset" class="btn btn-success">Reset</a>-->
            </div>
            <!--@if(isset($proveedor->nro_rupae_proveedor) && $proveedor->nro_rupae_proveedor!=null)
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAltaInscripcion">
                    {{ 'Finalizar' }}
                </button>
            @endif-->
        </div>

    </form>
    @include('edicionesModales.editarpagos')
    @include('edicionesModales.pagos')
    @include('edicionesModales.editarActividades')
    @include('edicionesModales.actividades')
    @include('edicionesModales.editarProducto')
    @include('edicionesModales.producto')
    @include('edicionesModales.altaSedes')
    @include('edicionesModales.editarSedes')
    @include('edicionesModales.altaSeguros')
    @include('edicionesModales.editarSeguros')
    @include('edicionesModales.altaVehiculos')
    @include('edicionesModales.editarVehiculos')
    @include('sucursales.create')

    <!--Incluimos el modal para editar los campos de las sucursales -->

    @include('sucursales.edit')

    <!--Incluimos el modal para dar de baja un registro -->
    <!-- Falta incluir el modal -->
    @include('modales.modalBajaSucursal')

    @yield('datos')

@endsection

@push('js')
    <script>
        $('input[type="checkbox"]').on('change', function() {
            this.value = this.checked ? 1 : 0;
            console.log(this.value);
        }).change();

        $('.btnNext').click(function() {
    $('.nav-tabs .active').parent().next('li').find('a').trigger('click');
})

$('.btnPrevious').click(function() {
    $('.nav-tabs .active').parent().prev('li').find('a').trigger('click');
})
    </script>
<script type="text/javascript">
    function valideKey(evt){

        // El código es la representación decimal ASCII de la clave presionada.
        var code = (evt.which) ? evt.which : evt.keyCode;

        if(code==8) { // espacio.
          return true;
        } else if(code>=48 && code<=57) { // es un numero.
          return true;
        } else{ // otras teclas
        console.log("no es un numero");
          return false;
        }
    }
    </script>

<script>

$('input[type="checkbox"]').on('change', function(){
    this.value = this.checked ? 1 : 0;
     console.log(this.value);
 }).change();

 window.onload = function(){

        recargarListaRealEdit2();
        recargarListaFiscal2();
        recargarListaLegal2();
        recargarListaHabilitacion2();

        };

</script>

<!-- Script para resetear los campos del formulario. Todavia no funciona bien.
Sugerencia: agregar una nueva clase a cada campo a borrar. -->

<!-- <script type="text/javascript">

    $("#reset").on("click", function(e) {

        //const inputs = document.getElementsByTagName('input');
        const inputs_text = document.querySelectorAll('[type="text"]');
        //const inputs_select = document.getElementsByTagName('select');
        const inputs_text_area = document.getElementsByTagName('textarea');
        const inputs_number = document.querySelectorAll('[type="number"]');
        const inputs_check = document.querySelectorAll('[type="checkbox"]');
        const inputs_email = document.querySelectorAll('[type="email"]');

        for(var i = 0; i < inputs_text.length; i++) {

            inputs_text[i].value = "";

        }

        /*for(var i = 0; i < inputs_select.length; i++) {

           inputs_select[i].value = "";

       }*/

       for(var i = 0; i < inputs_text_area.length; i++) {

        inputs_text_area[i].value = "";

       }

       for(var i = 0; i < inputs_number.length; i++) {

           inputs_number[i].value = "";

       }


       for(var i = 0; i < inputs_check.length; i++) {

           inputs_check[i].checked = 0;

       }


       for(var i = 0; i < inputs_email.length; i++) {

           inputs_email[i].value = "";

       }

    });

</script>

<script>
    $("#reset").on("click", function(e) {
        $(".limpiar").val('');
        $('#edit_form :select').selectedIndex = 1;
        $.ajax({
          url:"{{route('limpiar')}}",
          data:{'id_proveedor':"{{$id}}"},
          type:'post'
       });
    });
</script>-->

@endpush

@push('css')
    <style>
        .progress-bar {
            background-color: #17a2b8;
            color: #000;
        }

    </style>
@endpush

