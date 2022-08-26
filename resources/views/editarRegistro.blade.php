@extends('layouts')

@section('content2')
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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
                <a class="nav-link " id="domicilioLegal-tab" data-toggle="tab" href="#domicilioLegal">Domicilio Legal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="domicilioFiscal-tab" data-toggle="tab" href="#domicilioFiscal">Domicilio fiscal</a>
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

    <small class="small" id="small-razon_social"></small>
    <small class="small" id="small-nombre_fantasia"></small>
    <small class="small" id="small-cuit4"></small>
    <small class="small" id="small-cuit2"></small>
    <small class="small" id="small-dni-legal"></small>
    <small class="small" id="small-apellido-legal"></small>
    <small class="small" id="small-nombre-legal"></small>

    <form id="edit_form" action="{{ url('editarProveedor/' . $proveedor->id_proveedor) }}" method="POST">
        @csrf

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade  @if (empty($tab)) {{ 'show active' }} @endif" id="datos-generales"
                role="tabpanel" aria-labelledby="nav-datos-generales-tab">
                @include('editarRegistro.datosGenerales',['mode'=>'edit'])
            </div>
            <div class="tab-pane fade" id="domicilioReal" role="tabpanel" aria-labelledby="nav-domicilioReal-tab">
            @include('editarRegistro.domicilio',['tipo_domicilio'=>'real', 'mode'=>'edit'])
            </div>
            <div class="tab-pane fade" id="domicilioLegal" role="tabpanel" aria-labelledby="nav-domicilioLegal-tab">
            @include('editarRegistro.domicilio',['tipo_domicilio'=>'legal', 'mode'=>'edit'])

            </div>
            <div class="tab-pane fade" id="domicilioFiscal" role="tabpanel"
                aria-labelledby="nav-domicilioFiscal.blade-tab">
                @include('editarRegistro.domicilio',['tipo_domicilio'=>'fiscal', 'mode'=>'edit'])
            </div>
            <div class="tab-pane fade @if ($tab == 'actividad') {{ 'show active' }} @endif " id="actividad"
                role="tabpanel" aria-labelledby="nav-actividad-tab">
                @include('editarRegistro.actividad',['mode'=>'edit'])
            </div>
            <div class="tab-pane fade  @if ($tab == 'pago') {{ 'show active' }} @endif" id="pagos"
                role="tabpanel" aria-labelledby="nav-pagos-tab">
                @include('editarRegistro.pagos',['mode'=>'edit'])
            </div>

        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <div class="btn-group">
                <button type="submit" name="finalizar" class="btn btn-success"> {{ 'Finalizar' }} </button>
               
            </div>
        </div>

    </form>

    @include('edicionesModales.editarpagos')
    @include('edicionesModales.pagos')
    @include('edicionesModales.editarActividades')
    @include('edicionesModales.actividades')

    @yield('datos')

@endsection

@push('js')
    <script>
        $(document).ready(function() 
        {
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

            if ($('#provincia_real_edit').val()!='')
                recargarListaDomicilio($('#provincia_real_edit').val(), $("#localidad_real_edit"));
            if ($('#provincia_legal_edit').val()!='')
                recargarListaDomicilio($('#provincia_legal_edit').val(), $('#localidad_legal_edit'));
            if ($('#provincia_fiscal_edit').val()!='')
                recargarListaDomicilio($('#provincia_fiscal_edit').val(), $('#localidad_fiscal_edit'));
            if ($('#provincia_habilitacion').val()!='')
                recargarListaHabilitacion();
            $("#edit_form").on('submit',function(e){
                console.log("detecta evento finalizar edicion");
                e.preventDefault();

                if(validarDni())
                    this.submit();
            });
            $('.btnNext').click(function() {
                $('.nav-tabs .active').parent().next('li').find('a').trigger('click');
            });

            $('.btnPrevious').click(function() {
                $('.nav-tabs .active').parent().prev('li').find('a').trigger('click');
            });
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

@push('css')
    <style>
        .progress-bar {
            background-color: #17a2b8;
            color: #000;
        }

    </style>

    <style>
        input:invalid:required {

            border: 1px dashed red;
        }

        input:hover:invalid:required {

            background-color: rgb(255, 76, 76);
        }
    </style>

@endpush
