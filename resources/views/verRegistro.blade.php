@extends('layouts')

@section('content2')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    @if($proveedor->dado_de_baja == 1)
    <div class="alert alert-danger" role="alert">
        El Registro con el Cuit: {{$proveedor->cuit}} esta dado de Baja
      </div>
    @endif

    <nav>
        <ul class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <li class="nav-item">
                <a class=" nav-link @if (empty($tab)) {{ 'active' }} @endif" id="datos-generales-tab"
                    data-toggle="tab" href="#datos-generales">Datos Generales</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link" id="domicilioReal-tab" data-toggle="tab" href="#domicilioReal">Domicilio Real</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="domicilioLegal-tab" data-toggle="tab" href="#domicilioLegal">Domicilio
                    Legal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="domicilioFiscal-tab" data-toggle="tab" href="#domicilioFiscal">Domicilio
                    fiscal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if ($tab == 'sucursal') {{ 'active' }} @endif" id="sucursales-tab"
                    data-toggle="tab" href="#sucursales">Sucursales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="infoImpositiva-tab" data-toggle="tab" href="#infoImpositiva">Informacion
                    Impositiva</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="ingresosbrutos-tab" data-toggle="tab" href="#ingresosbrutos">Impuestos sobre
                    ingresos brutos</a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if ($tab == 'actividad') {{ 'active' }} @endif" id="actividad-tab"
                    data-toggle="tab" href="#actividad">Actividad</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="valorAgregado-tab" data-toggle="tab" href="#valorAgregado">Valor Agregado</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="personalOcupado-tab" data-toggle="tab" href="#personalOcupado">Personal
                    Ocupado</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if ($tab == 'pago') {{ 'active' }} @endif" id="pagos-tab"
                    data-toggle="tab" href="#pagos">Pagos</a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if ($tab == 'patente') {{ 'active' }} @endif " id="patente-tab"
                    data-toggle="tab" href="#patente">Patente y Seguro</a>
            </li>

        <!--    <li class="nav-item">
                <a class="nav-link " id="otrosDatos-tab" data-toggle="tab" href="#otrosDatos">Otros
                    Datos</a>
            </li> -->

        </ul>

        <br>

    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade  @if (empty($tab)) {{ 'show active' }} @endif" id="datos-generales"
            role="tabpanel" aria-labelledby="nav-datos-generales-tab">
            @include('editarRegistro.datosGenerales')
        </div>
        <div class="tab-pane fade" id="domicilioReal" role="tabpanel" aria-labelledby="nav-domicilioReal-tab">
            @include('editarRegistro.domicilioReal')
        </div>
        <div class="tab-pane fade" id="domicilioLegal" role="tabpanel" aria-labelledby="nav-domicilioLegal-tab">
            @include('editarRegistro.domicilioLegal')

        </div>
        <div class="tab-pane fade @if ($tab == 'sucursal') {{ 'show active' }} @endif" id="sucursales"
            role="tabpanel" aria-labelledby="nav-sucursales-tab">
            @include('editarRegistro.sucursales')
        </div>
        <div class="tab-pane fade" id="infoImpositiva" role="tabpanel" aria-labelledby="nav-infoImpositiva-tab">
            @include('editarRegistro.infoImpositiva')
        </div>
        <div class="tab-pane fade" id="ingresosbrutos" role="tabpanel" aria-labelledby="nav-ingresosbrutos-tab">
            @include('editarRegistro.Impuestosingresosbrutos')
        </div>
        <div class="tab-pane fade" id="domicilioFiscal" role="tabpanel" aria-labelledby="nav-domicilioFiscal.blade-tab">
            @include('editarRegistro.domicilioFiscal')
        </div>
        <div class="tab-pane fade @if ($tab == 'actividad') {{ 'show active' }} @endif " id="actividad"
            role="tabpanel" aria-labelledby="nav-actividad-tab">
            @include('editarRegistro.actividad')
        </div>
        <div class="tab-pane fade" id="valorAgregado" role="tabpanel" aria-labelledby="nav-valorAgregado-tab">
            @include('editarRegistro.valorAgregado')

        </div>
        <div class="tab-pane fade" id="personalOcupado" role="tabpanel" aria-labelledby="nav-personalOcupado-tab">
            @include('editarRegistro.personalOcupado')
        </div>
        <div class="tab-pane fade  @if ($tab == 'pago') {{ 'show active' }} @endif" id="pagos" role="tabpanel"
            aria-labelledby="nav-pagos-tab">
            @include('editarRegistro.pagos')
        </div>

        <div class="tab-pane fade  @if ($tab == 'patente') {{ 'show active' }} @endif" id="patente"
            role="tabpanel" aria-labelledby="nav-patente-tab">
            @include('editarRegistro.patenteSeguro')
        </div>

        <!-- <div class="tab-pane fade" id="otrosDatos" role="tabpanel" aria-labelledby="nav-otrosDatos-tab"> -->
         {{-- @include('editarRegistro.otrosDatos') --}}   <!-- </div> -->
    </div>
    @include('edicionesModales.editarpagos')
    @include('edicionesModales.editarActividades')
    @include('edicionesModales.editarProducto')
    {{-- @include('edicionesModales.sucursales') --}}
    @include('edicionesModales.editarSedes')
    @include('edicionesModales.editarSeguros')
    @include('edicionesModales.editarVehiculos')
    @include('edicionesModales.palabraClave')
    @include('edicionesModales.editarPalabraClave')

    <!--Incluimos el modal para editar los campos de las sucursales -->

    @include('sucursales.edit')

    @yield('datos')
    <br>

    @if ($mode == 'show')
    @if($proveedor->dado_de_baja != 1)
        <a href="{{ url('registro-alta/' . $id) }}" class="btn btn-outline-dark" target="_blank">Descargar Registro alta</a>
        <a href="{{ url('certificado-inscripcion/' . $id) }}" class="btn btn-outline-dark" target="_blank">Descargar Certificado inscripción</a>
        <a href="#" class="btn btn-outline-info" id="nuevos_certificados">Generar Nuevos Certificados</a>

    @endif

    @endif


@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>


    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $("#document").ready(function(){
            $("#nuevos_certificados").click(function(){
                let timerInterval
Swal.fire({
  title: 'Generando Nuevos Certificados!',
  timer: 9999,
  timerProgressBar: true,
  didOpen: () => {
    Swal.showLoading()

  },
  willClose: () => {
    clearInterval(timerInterval)
  }
}).then((result) => {
  /* Read more about handling dismissals below */
  if (result.dismiss === Swal.DismissReason.timer) {
    console.log('I was closed by the timer')
  }
})
                $.ajax({
                    url: "{{url('/nuevo-registro/'.$id)}}"
                    }).done( function() {

                        Swal.fire({
                            position: 'top-end',
                            icon: 'info',
                            title: 'Nuevos certificados generados',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })
                });
            });
        });

        $('input[type="checkbox"]').on('change', function() {
            this.value = this.checked ? 1 : 0;
            //console.log(this.value);
        }).change();

        $('.btnNext').click(function() {
            $('.nav-tabs .active').parent().next('li').find('a').trigger('click');
        })

        $('.btnPrevious').click(function() {
            $('.nav-tabs .active').parent().prev('li').find('a').trigger('click');
        })
    </script>
    <script type="text/javascript">
        function valideKey(evt) {

            // El código es la representación decimal ASCII de la clave presionada.
            var code = (evt.which) ? evt.which : evt.keyCode;

            if (code == 8) { // espacio.
                return true;
            } else if (code >= 48 && code <= 57) { // es un numero.
                return true;
            } else { // otras teclas
                //console.log("no es un numero");
                return false;
            }
        }
    </script>

    <script>
        $('input[type="checkbox"]').on('change', function() {
            this.value = this.checked ? 1 : 0;
            //console.log(this.value);
        }).change();

        window.onload = function() {

            $("#dni_legal").val(function (index, value ) {
    return value.replace(/\D/g, "")
                .replace(/([0-9])([0-9]{3})$/, '$1.$2')
                .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
});

$("#cuit").val(function (index, value ) {
    return value.replace(/\D/g, "")
                .replace(/([0-9])([0-9]{1})$/, '$1-$2')
                .replace(/^([0-9]{2})/, '$1-')

});

            $("#masa_salarial_bruta").val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1,$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
        });

        $("#facturacion_anual_alcanzada").val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1,$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
        });

            @if (!$proveedor_domicilio_real->id_localidad == '')
                recargarListaRealEdit2();
            @endif
            @if (!$proveedor_domicilio_fiscal->id_localidad == '')
                recargarListaFiscal2();
            @endif

            @if (!$proveedor_domicilio_legal->id_localidad == '')
                recargarListaLegal2();
            @endif

            @if (!$proveedor->localidad_habilitacion == '')
                recargarListaHabilitacion2();
            @endif


        };
    </script>

@endpush

@push('css')
    <style>
        .progress-bar {
            background-color: #17a2b8;
            color: #000;
        }

    </style>
@endpush
