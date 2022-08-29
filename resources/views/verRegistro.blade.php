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
                <a class="nav-link @if ($tab == 'actividad') {{ 'active' }} @endif" id="actividad-tab"
                    data-toggle="tab" href="#actividad">Actividad</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if ($tab == 'pago') {{ 'active' }} @endif" id="pagos-tab"
                    data-toggle="tab" href="#pagos">Pagos</a>
            </li>
        </ul>

        <br>

    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade  @if (empty($tab)) {{ 'show active' }} @endif" id="datos-generales"
            role="tabpanel" aria-labelledby="nav-datos-generales-tab">
            @include('editarRegistro.datosGenerales',['mode'=>'show'])
        </div>
        <div class="tab-pane fade" id="domicilioReal" role="tabpanel" aria-labelledby="nav-domicilioReal-tab">
            @include('editarRegistro.domicilio',['tipo_domicilio'=>'real', 'mode'=>'show'])
        </div>
        <div class="tab-pane fade" id="domicilioLegal" role="tabpanel" aria-labelledby="nav-domicilioLegal-tab">
            @include('editarRegistro.domicilio',['tipo_domicilio'=>'legal', 'mode'=>'show'])

        </div>
        <div class="tab-pane fade" id="domicilioFiscal" role="tabpanel" aria-labelledby="nav-domicilioFiscal.blade-tab">
            @include('editarRegistro.domicilio',['tipo_domicilio'=>'fiscal', 'mode'=>'show'])
        </div>
        <div class="tab-pane fade @if ($tab == 'actividad') {{ 'show active' }} @endif " id="actividad"
            role="tabpanel" aria-labelledby="nav-actividad-tab">
            @include('editarRegistro.actividad',['mode'=>'show'])
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

    @if ($mode == 'show')
    @if($proveedor->dado_de_baja != 1)
        <a href="{{ url('registro-alta/' . $id) }}" class="btn btn-outline-dark" target="_blank">Descargar Registro alta</a>
        <a href="{{ url('certificado-inscripcion/' . $id) }}" class="btn btn-outline-dark" target="_blank">Descargar Certificado inscripción</a>
        <a href="#" class="btn btn-outline-info" id="nuevos_certificados">Generar Nuevos Certificados</a>

    @endif

    @endif


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
            if ($('#provincia_real_show').val()!='')
                recargarListaDomicilio($('#provincia_real_show').val(), $("#localidad_real_show"));
            if ($('#provincia_legal_show').val()!='')
                recargarListaDomicilio($('#provincia_legal_show').val(), $('#localidad_legal_show'));
            if ($('#provincia_fiscal_show').val()!='')
                recargarListaDomicilio($('#provincia_fiscal_show').val(), $('#localidad_fiscal_show'));
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
        function recargarListaDomicilio(provincia_selected, select_localidad){
            console.log("entra en esta funcion de recarga de localidades");
            $.ajax({
                type:"GET",
                url:"{{url('localidades')}}/"+provincia_selected,
                success:function(r){
                    select_localidad.html(r);
                }
            }).done(function(){
                let proveedor = @json($proveedor);
                if(proveedor.domicilio_real!=null && proveedor.domicilio_real.localidad!=null)
                    if ($('#provincia_real_edit').val()!='')
                        $("#localidad_real_edit option[value='"+proveedor.domicilio_real.localidad.id_localidad+"']").attr("selected", true);
                if(proveedor.domicilio_legal!=null && proveedor.domicilio_legal.localidad!=null)
                    if ($('#provincia_legal_edit').val()!='')
                        $("#localidad_legal_edit option[value='"+proveedor.domicilio_legal.localidad.id_localidad+"']").attr("selected", true);
                if(proveedor.domicilio_fiscal!=null && proveedor.domicilio_fiscal.localidad!=null)
                    if ($('#provincia_fiscal_edit').val()!='')
                        $("#localidad_fiscal_edit option[value='"+proveedor.domicilio_fiscal.localidad.id_localidad+"']").attr("selected", true);
            });
        }

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
