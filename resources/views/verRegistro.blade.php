@extends('layouts')

@section('content2')
    @if($proveedor->dado_de_baja == 1)
    <div class="alert alert-danger" role="alert">
        El Registro con el Cuit: {{$proveedor->cuit}} esta dado de Baja
      </div>
    @endif

    <nav>
        <ul class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <li class="nav-item">
                <a class=" nav-link @if (empty($tab)) {{ 'active' }} @endif" id="disposiciones-tab"
                    data-toggle="tab" href="#disposiciones">Disposiciones</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link" id="datos-generales-tab"
                    data-toggle="tab" href="#datos-generales">Datos Generales</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link" id="miembros-tab" data-toggle="tab" href="#miembros">Miembros</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link" id="direccion-firma-tab" data-toggle="tab" href="#direccionFirma">Dirección y Firma</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link" id="apoderado-tab" data-toggle="tab" href="#apoderado">Apoderado</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link" id="domicilioReal-tab" data-toggle="tab" href="#domicilioReal">Domicilio Real</a>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="domicilioFiscal-tab" data-toggle="tab" href="#domicilioFiscal">Domicilio
                    fiscal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if ($tab == 'actividad') {{ 'active' }} @endif" id="actividad-tab"
                    data-toggle="tab" href="#actividad">Actividad</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if ($tab == 'historial-actividad') {{ 'active' }} @endif" id="historial-actividad-tab"
                    data-toggle="tab" href="#historial-actividad">Historial de actividades</a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if ($tab == 'firma') {{ 'active' }} @endif" id="firma-tab"
                    data-toggle="tab" href="#firma">Firma</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if ($tab == 'referencia bancaria') {{ 'active' }} @endif" id="referencia-bancaria-tab"
                    data-toggle="tab" href="#referencia-bancaria">Referencia Bancaria</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if ($tab == 'pago') {{ 'active' }} @endif" id="pagos-tab"
                    data-toggle="tab" href="#pagos">Pagos</a>
            </li>
        </ul>

        <br>

    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade  @if (empty($tab)) {{ 'show active' }} @endif" id="disposiciones"
                role="tabpanel" aria-labelledby="nav-disposiciones-tab">
                @include('editarRegistro.disposicion',['mode'=>'show'])
            </div>
        <div class="tab-pane fade  " id="datos-generales"
            role="tabpanel" aria-labelledby="nav-datos-generales-tab">
            @include('editarRegistro.datosGenerales',['mode'=>'show'])
        </div>
        <div class="tab-pane fade" id="miembros" role="tabpanel" aria-labelledby="nav-miembros-tab">
            @include('editarRegistro.persona',['tipo_persona'=>'miembro', 'mode'=>'show'])
        </div>
        <div class="tab-pane fade" id="direccionFirma" role="tabpanel" aria-labelledby="nav-direccion-firma-tab">
            @include('editarRegistro.persona',['tipo_persona'=>'direccion_firma', 'mode'=>'show'])
        </div>
        <div class="tab-pane fade" id="apoderado" role="tabpanel" aria-labelledby="nav-apoderado-tab">
            @include('editarRegistro.persona',['tipo_persona'=>'apoderado', 'mode'=>'show'])
        </div>
        <div class="tab-pane fade" id="domicilioReal" role="tabpanel" aria-labelledby="nav-domicilioReal-tab">
            @include('editarRegistro.domicilio',['tipo_domicilio'=>'real', 'mode'=>'show'])
        </div>

        <div class="tab-pane fade" id="domicilioFiscal" role="tabpanel" aria-labelledby="nav-domicilioFiscal.blade-tab">
            @include('editarRegistro.domicilio',['tipo_domicilio'=>'fiscal', 'mode'=>'show'])
        </div>
        <div class="tab-pane fade @if ($tab == 'actividad') {{ 'show active' }} @endif " id="actividad"
            role="tabpanel" aria-labelledby="nav-actividad-tab">
            @include('editarRegistro.actividad',['mode'=>'show'])
        </div>
        <div class="tab-pane fade @if ($tab == 'historial-actividad') {{ 'show active' }} @endif " id="historial-actividad"
        role="tabpanel" aria-labelledby="nav-historial-actividad-tab">
        @include('editarRegistro.historialActividad',['mode'=>'show'])
        </div>

        <div class="tab-pane fade @if ($tab == 'firma') {{ 'show active' }} @endif " id="firma"
            role="tabpanel" aria-labelledby="nav-firma-tab">
            @include('editarRegistro.firmas',['mode'=>'show'])
        </div>
        <div class="tab-pane fade @if ($tab == 'referencia bancaria') {{ 'show active' }} @endif " id="referencia-bancaria" role="tabpanel" aria-labelledby="nav-referencia-bancaria-tab">
            @include('editarRegistro.referenciasBancarias',['mode'=>'show'])
        </div>
        <div class="tab-pane fade  @if ($tab == 'pago') {{ 'show active' }} @endif" id="pagos" role="tabpanel"
            aria-labelledby="nav-pagos-tab">
            @include('editarRegistro.pagos',['mode'=>'show'])
        </div>
    </div>

    @include('edicionesModales.editarpagos')
    @include('edicionesModales.editarActividades')

    @yield('datos')
    <br>





@endsection

@push('js')
    <script>
        $("#document").ready(function(){
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

            if ($('#provincia_habilitacion').val()!='')
                recargarListaHabilitacion();
            $("#nuevos_certificados").click(function()
            {
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
            $('.btnNext').click(function() {
                $('.nav-tabs .active').parent().next('li').find('a').trigger('click');
            })

            $('.btnPrevious').click(function() {
                $('.nav-tabs .active').parent().prev('li').find('a').trigger('click');
            })
        });


        function recargarListaHabilitacion(){
            $.ajax({
            type:"GET",
                    url:"{{url('localidades')}}/"+$('#provincia_habilitacion').val(),

            success:function(r){
                $('#localidad_habilitacion').html(r);
            }
            }).done(function(){
            let localidad_habilitacion = @json($proveedor->localidad_habilitacion);
            if($("#provincia_habilitacion").val()!='' && localidad_habilitacion != null)
                $("#localidad_habilitacion option[value='"+localidad_habilitacion+"']").attr("selected", true);
            });
        }

    </script>

@endpush
