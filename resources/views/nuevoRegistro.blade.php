@extends('layouts')

@section('content2')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script>
        $(document).ready(function() {

            $('input[type="checkbox"]').on('change', function(){
            this.value = this.checked ? 1 : 0;
            //console.log(this.value);
        }).change();

            var current = 1,
                current_step, next_step, steps;
            steps = $("fieldset").length;

            $(".next").click(function(e) {
                let tipo_domicilio = $(this).data('tipo-domicilio');
                if(tipo_domicilio)
                {
                    let form_localidad;
                    let form_calle;
                    let form_numero;
                    let form_manzana;
                    let form_lote;
                    let form_barrio;
                    let form_small_domicilio;
                    switch(tipo_domicilio)
                    {
                        case 'real':
                            form_localidad=$("#localidad_real_create");
                            form_calle=$("#calle_real_create");
                            form_numero=$("#numero_real_create");
                            form_monoblock=$("#monoblock_real_create");
                            form_dpto=$("#dpto_real_create");
                            form_puerta=$("#puerta_real_create");
                            form_oficina=$("#oficina_real_create")
                            form_entreCalles=$("#entreCalles_real_create");
                            form_manzana=$("#manzana_real_create");
                            form_lote=$("#lote_real_create");
                            form_barrio=$("#barrio_real_create");
                            form_cp=$("#cp_real_create");
                            form_small_domicilio=$("#small-domicilio-real-head");
                        break;
                        case 'fiscal':
                            form_localidad=$("#localidad_fiscal_create");
                            form_calle=$("#calle_fiscal_create");
                            form_numero=$("#numero_fiscal_create");
                            form_monoblock=$("#monoblock_fiscal_create");
                            form_dpto=$("#dpto_fiscal_create");
                            form_puerta=$("#puerta_fiscal_create");
                            form_oficina=$("#oficina_fiscal_create")
                            form_entreCalles=$("#entreCalles_fiscal_create");
                            form_manzana=$("#manzana_fiscal_create");
                            form_lote=$("#lote_fiscal_create");
                            form_barrio=$("#barrio_fiscal_create");
                            form_cp=$("#cp_fiscal_create");
                            form_small_domicilio=$("#small-domicilio-fiscal-head");
                        break;
                    }
                    
                    if(form_localidad.val()!=''||form_calle.val()!=''||form_numero.val()!=''||form_monoblock.val()!=''||form_dpto.val()!=''||form_puerta.val()!=''||form_oficina.val()!=''||form_entreCalles.val()!=''||form_manzana.val()!=''||form_lote.val()!=''||form_barrio.val()!=''||form_cp.val()!='')
                    {
                        if(comprobarDatoDomicilio(tipo_domicilio,form_localidad,form_calle,form_numero,form_manzana,form_lote,form_barrio,form_small_domicilio))
                        {
                            ocultarErrorDomicilio(form_small_domicilio);
                            current_step = $(this).parent();
                            next_step = $(this).parent().next();
                            next_step.show();
                            current_step.hide();
                            setProgressBar(++current);
                            $(window).scrollTop(0);
                            
                        }
                    }
                    else
                    {
                        ocultarErrorDomicilio(form_small_domicilio);
                        current_step = $(this).parent();
                        next_step = $(this).parent().next();
                        next_step.show();
                        current_step.hide();
                        setProgressBar(++current);
                        $(window).scrollTop(0);
                    }
                }
                else
                {
                    current_step = $(this).parent();
                    next_step = $(this).parent().next();
                    next_step.show();
                    current_step.hide();
                    setProgressBar(++current);
                    $(window).scrollTop(0);
                    let tipo_persona = $(this).data('tipo-persona');
                    if(tipo_persona)
                        borrarAdvertenciasPersona(tipo_persona);
                    let tipo = $(this).data('tipo');
                    if(tipo)
                    {
                        console.log(tipo);

                        if(tipo=='datos_generales')
                        {
                            if($("#razon_social").val()=='')
                                mostrarError('#razon_social', '#small-razon-social-head', '<div class="alert alert-danger mt-3 pt-1">La razon social <strong>no</strong> puede quedar vacía.</div>');
                            else
                                ocultarError('#razon_social', '#small-razon-social-head');
                            if($("#nombre_fantasia").val()=='')
                                mostrarError('#nombre_fantasia', '#small-nombre-fantasia-head', '<div class="alert alert-danger mt-3 pt-1">El Nombre de Fantasia <strong>no</strong> puede quedar vacía.</div>');
                            else
                                ocultarError('#nombre_fantasia', '#small-nombre-fantasia-head');
                        }
                        if(tipo=='firma')
                            borrarAdvertenciasFirma();
                        if(tipo=='banco')
                            borrarAdvertenciasBanco()
                    }
                }
            });

            $(".previous").click(function() {
                current_step = $(this).parent();
                next_step = $(this).parent().prev();
                next_step.show();
                current_step.hide();
                setProgressBar(--current);
                $(window).scrollTop(0);
                let tipo_persona = $(this).data('tipo-persona');
                if(tipo_persona)
                    borrarAdvertenciasPersona(tipo_persona);
                    let tipo = $(this).data('tipo');
                if(tipo)
                {
                    if(tipo=='firma')
                        borrarAdvertenciasFirma();
                    if(tipo=='banco')
                        borrarAdvertenciasBanco()
                }
            });

            setProgressBar(current);
            // Change progress bar action
            function setProgressBar(curStep) {
                var percent = parseFloat(100 / steps) * curStep;
                percent = percent.toFixed();
                $(".progress-bar")
                    .css("width", percent + "%")
                    .html(percent + "%");
            }
        });


        function borrarAdvertenciasPersona(tipo_persona)
        {
            if(tipo_persona != 'direccion_firma')
            {
                if($('#dni_'+tipo_persona+'_create').val()=='' && $('#apellido_'+tipo_persona+'_create').val()=='' && $('#nombre_'+tipo_persona+'_create').val()=='')
                {
                    ocultarError('#dni_'+tipo_persona+'_create', '#small-dni-'+tipo_persona+'-head');
                    ocultarError('#apellido_'+tipo_persona+'_create', '#small-apellido-'+tipo_persona+'-head');
                    ocultarError('#nombre_'+tipo_persona+'_create', '#small-nombre-'+tipo_persona+'-head');
                }
            }
            else
            {
                if($('#dni_'+tipo_persona+'_create').val()=='' && $('#apellido_'+tipo_persona+'_create').val()=='' && $('#nombre_'+tipo_persona+'_create').val()=='' && $('#cargo_'+tipo_persona+'_create').val()=='')
                {
                    ocultarError('#dni_'+tipo_persona+'_create', '#small-dni-'+tipo_persona+'-head');
                    ocultarError('#apellido_'+tipo_persona+'_create', '#small-apellido-'+tipo_persona+'-head');
                    ocultarError('#nombre_'+tipo_persona+'_create', '#small-nombre-'+tipo_persona+'-head');
                    ocultarError('#cargo_'+tipo_persona+'_create', '#small-cargo-'+tipo_persona+'-head');
                }
            }
        }

        function borrarAdvertenciasFirma()
        {
            ocultarError($('#denominacion_create'), '#small-denominacion-head');
        }

        function borrarAdvertenciasBanco()
        {
            if($("#nombre_banco_create").val()=='' && $("#localidad_sucursal_create").val()=='' && $('#tipo_cuenta_create').val()=='' && $('#nro_cuenta_create').val()=='')
            {
                $("#nombre_banco_create").parents('.form-group').find('.select2-selection').css('border', '1px solid #ccc');
                ocultarError($('#nombre_banco_create'), '#small-banco-head');
                $("#localidad_sucursal_create").parents('.form-group').find('.select2-selection').css('border', '1px solid #ccc');
                ocultarError($('#localidad_sucursal_create'), '#small-localidad-sucursal-head');
                ocultarError($('#tipo_cuenta_create'), '#small-tipo-cuenta-head');
                ocultarError($('#nro_cuenta_create'), '#small-nro-cuenta-head');
            }
        }

        function comprobarDatoDomicilio(tipo, form_localidad, form_calle, form_numero, form_manzana, form_lote, form_barrio, form_small_domicilio){
            if(form_localidad.val() == '')
            {
                if(form_calle.val()=='')
                {
                    if(form_numero.val()=='')
                    {
                        if(form_manzana.val()=='')
                        {
                            if(form_lote.val()=='')
                            {
                                if(form_barrio.val()=='')
                                {
                                    mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir: <br><ol><li>calle, numero y localidad; o </li><li> manzana, lote, barrio y localidad</li></ol></div>');
                                    return false;
                                }
                                else
                                {
                                    mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir: manzana, lote y localidad</div>');
                                    return false;
                                }
                            }
                            else
                            {
                                if(form_barrio.val()=='')
                                {
                                    mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir: manzana, barrio y localidad</div>');
                                    return false;
                                }
                                else
                                {
                                    mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir:manzana y localidad</div>');
                                    return false;
                                }
                            }
                        }
                        else
                        {
                            if(form_lote.val()=='')
                            {
                                if(form_barrio.val()=='')
                                {
                                    mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir: lote, barrio y localidad</li></ol></div>');
                                    return false;
                                }
                                else
                                {
                                    mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir:lote y localidad</div>');
                                    return false;
                                }
                            }
                            else
                            {
                                if(form_barrio.val()=='')
                                {
                                    mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir: barrio y localidad</div>');
                                    return false;
                                }
                                else
                                {
                                    mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir: localidad</div>');
                                    return false;
                                }
                            }
                        }
                    }
                    else
                    {
                        mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir: localidad</div>');
                        return false;
                    }
                }
                else
                {
                    if(form_numero.val()=='')
                    {
                        mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir: numero y localidad</div>');
                        return false;
                    }
                    else
                        mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir: localidad</div>');
                        return false;
                }
            }
            else
            {
                if(form_calle.val()=='')
                {
                    if(form_numero.val()=='')
                    {
                        if(form_manzana.val()=='')
                        {
                            if(form_lote.val()=='')
                            {
                                if(form_barrio.val()=='')
                                {
                                    mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir: <br><ol><li>calle, numero y localidad; o </li><li> manzana, lote, barrio y localidad</li></ol></div>');
                                    return false;
                                }
                                else
                                {
                                    mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir: manzana, lote y localidad</div>');
                                    return false;
                                }
                            }
                            else
                            {
                                if(form_barrio.val()=='')
                                {
                                    mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir: manzana, barrio y localidad</div>');
                                    return false;
                                }
                                else
                                {
                                    mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir:manzana y localidad</div>');
                                    return false;
                                }
                            }
                        }
                        else
                        {
                            if(form_lote.val()=='')
                            {
                                if(form_barrio.val()=='')
                                {
                                    mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir: lote, barrio y localidad</li></ol></div>');
                                    return false;
                                }
                                else
                                {
                                    mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir:lote y localidad</div>');
                                    return false;
                                }
                            }
                            else
                            {
                                if(form_barrio.val()=='')
                                {
                                    mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir: barrio y localidad</div>');
                                    return false;
                                }
                                else
                                    return true;
                            }
                        }
                    }
                    else
                    {
                        mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir: localidad</div>');
                        return false;
                    }
                }
                else
                {
                    if(form_numero.val()=='')
                    {
                        mostrarErrorDomicilio(form_small_domicilio, '<div class="alert alert-danger mt-3 pt-1">Para agregar el domicilio '+tipo+' debe incluir: numero y localidad</div>');
                        return false;
                    }
                    else
                        return true;
                }
            }
        }

    </script>



    <style>
        #regiration_form fieldset:not(:first-of-type) {
            display: none;
        }

        $form-validation-states: (
            "valid": (
                "color": $form-feedback-valid-color,
                "icon": $form-feedback-icon-valid
            ),
            "invalid": (
                "color": $form-feedback-invalid-color,
                "icon": $form-feedback-icon-invalid
            )
        );

        .invalid.select2-selection
        {
            border: 1px solid red;
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

    <small class="small" id="small-tipo-disposicion-head"></small>
    <small class="small" id="small-nro-expte-head"></small>
    <small class="small" id="small-inicio-disposicion-head"></small>
    <small class="small" id="small-fin-disposicion-head"></small>
    <small class="small" id="small-fecha-mayor-fin-disposicion-head"></small>
    <small class="small" id="small-razon-social-head"></small>
    <small class="small" id="small-nombre-fantasia-head"></small>
    <small class="small" id="small-cuit-mal-formato-head"></small>
    <small class="small" id="small-cuit-vacio-head"></small>
    <small class="small" id="small-dni-miembro-head"></small>
    <small class="small" id="small-apellido-miembro-head"></small>
    <small class="small" id="small-nombre-miembro-head"></small>
    <small class="small" id="small-dni-direccion_firma-head"></small>
    <small class="small" id="small-apellido-direccion_firma-head"></small>
    <small class="small" id="small-nombre-direccion_firma-head"></small>
    <small class="small" id="small-cargo-direccion_firma-head"></small>
    <small class="small" id="small-dni-apoderado-head"></small>
    <small class="small" id="small-apellido-apoderado-head"></small>
    <small class="small" id="small-nombre-apoderado-head"></small>
    <small class="small" id="small-domicilio-real-head"></small>
    <small class="small" id="small-domicilio-legal-head"></small>
    <small class="small" id="small-domicilio-fiscal-head"></small>
    <small class="small" id="small-denominacion-head"></small>
    <small class="small" id="small-banco-head"></small>
    <small class="small" id="small-localidad-sucursal-head"></small>
    <small class="small" id="small-tipo-cuenta-head"></small>
    <small class="small" id="small-nro-cuenta-head"></small>


    <form  id="regiration_form" action="{{ route('crear_registro') }}"  method="POST">
        @csrf
        @include('editarRegistro.datosGenerales',['mode'=>'create'])
        @include('altaRegistro.persona',['tipo_persona'=>'miembro', 'mode'=>'create'])
        @include('altaRegistro.persona',['tipo_persona'=>'direccion_firma', 'mode'=>'create'])
        @include('altaRegistro.persona',['tipo_persona'=>'apoderado', 'mode'=>'create'])
        @include('editarRegistro.domicilio',['tipo_domicilio'=>'real', 'mode'=>'create'])
        @include('editarRegistro.domicilio',['tipo_domicilio'=>'fiscal', 'mode'=>'create'])
        @include('altaRegistro.firmas',['mode'=>'create'])
        @include('altaRegistro.referenciasBancarias',['mode'=>'create'])
        @include('altaRegistro.pagos',['mode'=>'create'])

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <div class="btn-group">
                <button type="submit" name="finalizar" class="btn finalizar btn-success"> {{ 'Finalizar' }} </button>
            </div>
        </div>


    </form>
    @yield('datos')

    @include('personas.modal-edit-create',['tipo_persona'=>'x', 'mode'=>'edit'])

    <!--Incluimos el modal para validar los campos -->

    @include('modales.validarFormularioAlta')

@endsection


@push('js')

<script type="text/javascript">

function validarForm(){
            let cont = 2;
            console.log(cont);

                if($("#razon_social").val()==''){
                    mostrarError('#razon_social', '#small-razon-social-head', '<div class="alert alert-danger mt-3 pt-1">La RAZON SOCIAL <strong>no</strong> puede quedar vacía.</div>');
                }else{
                    ocultarError('#razon_social', '#small-razon-social-head');
                    cont--;}
                if($("#nombre_fantasia").val()==''){
                    mostrarError('#nombre_fantasia', '#small-nombre-fantasia-head', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE DE FANTASIA <strong>no</strong> puede quedar vacía.</div>');
                }else{
                    ocultarError('#nombre_fantasia', '#small-nombre-fantasia-head');
                    cont--;}


            console.log(cont);
            return cont;

}

$(".finalizar").click(function(e){
            console.log("prueba captura de formulario");
            e.preventDefault();
            var form = $(this);

            if(validarForm() === 0){
                $("#regiration_form").submit();

            }


        });

    $(document).ready(function()
    {


        $( ".dni" ).autocomplete({
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
                let dni_persona=$(this);
                let tipo_persona = dni_persona.data('tipo-persona');
                let mode=dni_persona.data('mode');
                switch(tipo_persona)
                {
                    case 'miembro':
                        if(mode=='create')
                        {
                            console.log("entra por miembro create");
                            $("#apellido_miembro_create").val(ui.item.apellido_persona);
                            $("#nombre_miembro_create").val(ui.item.nombre_persona);
                            ocultarError('#dni_miembro_create', '#small-dni-miembro-create');
                            ocultarError('#dni_miembro_create', '#small-dni-miembro-head');
                            ocultarError('#apellido_miembro_create', '#small-apellido-miembro-create');
                            ocultarError('#apellido_miembro_create', '#small-apellido-miembro-head');
                            ocultarError('#nombre_miembro_create', '#small-nombre-miembro-create');
                            ocultarError('#nombre_miembro_create', '#small-nombre-miembro-head');
                        }
                        else
                            if(mode=='edit')
                            {
                                console.log("entra por miembro create");
                                $("#apellido_miembro_edit").val(ui.item.apellido_persona);
                                $("#nombre_miembro_edit").val(ui.item.nombre_persona);
                                ocultarError('#dni_miembro_edit', '#small-dni-miembro-edit');
                                ocultarError('#dni_miembro_edit', '#small-dni-miembro-head');
                                ocultarError('#apellido_miembro_edit', '#small-apellido-miembro-edit');
                                ocultarError('#apellido_miembro_edit', '#small-apellido-miembro-head');
                                ocultarError('#nombre_miembro_edit', '#small-nombre-miembro-edit');
                                ocultarError('#nombre_miembro_edit', '#small-nombre-miembro-head');
                            }
                    break;
                    case 'direccion_firma':
                        if(mode=='create')
                        {
                            console.log("entra por direccion firma create");
                            $("#apellido_direccion_firma_create").val(ui.item.apellido_persona);
                            $("#nombre_direccion_firma_create").val(ui.item.nombre_persona);
                            ocultarError('#dni_direccion_firma_create', '#small-dni-direccion_firma-create');
                            ocultarError('#dni_direccion_firma_create', '#small-dni-direccion_firma-head');
                            ocultarError('#apellido_direccion_firma_create', '#small-apellido-direccion_firma-create');
                            ocultarError('#apellido_direccion_firma_create', '#small-apellido-direccion_firma-head');
                            ocultarError('#nombre_direccion_firma_create', '#small-nombre-direccion_firma-create');
                            ocultarError('#nombre_direccion_firma_create', '#small-nombre-direccion_firma-head');
                        }
                        else
                            if(mode=='edit')
                            {
                                console.log("entra por direccion firma edit");
                                $("#apellido_direccion_firma_edit").val(ui.item.apellido_persona);
                                $("#nombre_direccion_firma_edit").val(ui.item.nombre_persona);
                                ocultarError('#dni-direccion_firma_edit', '#small-dni-direccion_firma-edit');
                                ocultarError('#dni_direccion_firma_edit', '#small-dni-direccion_firma-head');
                                ocultarError('#apellido_direccion_firma_edit', '#small-apellido-direccion_firma-edit');
                                ocultarError('#apellido_direccion_firma_edit', '#small-apellido-direccion_firma-head');
                                ocultarError('#nombre_direccion_firma_edit', '#small-nombre-direccion_firma-edit');
                                ocultarError('#nombre_direccion_firma_edit', '#small-nombre-direccion_firma-head');
                            }
                    break;
                    case 'apoderado':
                        if(mode=='create')
                        {
                            console.log("entra por apoderado create");
                            $("#apellido_apoderado_create").val(ui.item.apellido_persona);
                            $("#nombre_apoderado_create").val(ui.item.nombre_persona);
                            ocultarError('#dni_apoderado_create', '#small-dni-apoderado-create');
                            ocultarError('#dni_apoderado_create', '#small-dni-apoderado-head');
                            ocultarError('#apellido_apoderado_create', '#small-apellido-apoderado-create');
                            ocultarError('#apellido_apoderado_create', '#small-apellido-apoderado-head');
                            ocultarError('#nombre_apoderado_create', '#small-nombre-apoderado-create');
                            ocultarError('#nombre_apoderado_create', '#small-nombre-apoderado-head');
                        }
                        else
                            if(mode=='edit')
                            {
                                console.log("entra por direccion firma edit");
                                $("#apellido_direccion_firma_edit").val(ui.item.apellido_persona);
                                $("#nombre_direccion_firma_edit").val(ui.item.nombre_persona);
                                ocultarError('#dni_apoderado_edit', '#small-dni-apoderado-edit');
                                ocultarError('#dni_apoderado_edit', '#small-dni-apoderado-head');
                                ocultarError('#apellido_apoderado_edit', '#small-apellido-apoderado-edit');
                                ocultarError('#apellido_apoderado_edit', '#small-apellido-apoderado-head');
                                ocultarError('#nombre_apoderado_edit', '#small-nombre-apoderado-edit');
                                ocultarError('#nombre_apoderado_edit', '#small-nombre-apoderado-head');
                            }
                    break;
                    case 'x':
                        $("#apellido_x_edit").val(ui.item.apellido_persona);
                        $("#nombre_x_edit").val(ui.item.nombre_persona);
                    break;
                }
            }
        });
        if ($('#provincia_real_create').val()!='')
            recargarListaDomicilio($('#provincia_real_create').val(), $("#localidad_real_create"));

        if ($('#provincia_fiscal_create').val()!='')
            recargarListaDomicilio($('#provincia_fiscal_create').val(), $('#localidad_fiscal_create'));

        //Modificamos los valores actuales, por los nuevos valores ingresados en el modal

        $(document).on("click", ".btn_edit_modal", function(event) {
            //Obtenemos el numero de la fila que queremos modificar
            var tipo_persona = $(this).data('tipo-persona');
            var id_filapersona = $("#numero_fila_persona").val();
            console.log("pasa por ak con id_filapersona ="+id_filapersona);
            if(id_filapersona!='')
            {
                //Si los campos obligatorios NO estan vacios, permite enviar los nuevos valores a la tabla
                if(validarExisteDatosPersonaModal(tipo_persona, 'edit', $("#dni_x_edit"), $("#apellido_x_edit"), $("#nombre_x_edit"), $("#cargo_x_edit")))
                {
                    //Recuperamos los valores de los campos del modal
                    var apellido_persona = $("#apellido_x_edit").val();
                    var nombre_persona = $("#nombre_x_edit").val();
                    var dni_persona = $("#dni_x_edit").val();
                    var cargo_persona='';
                    if(tipo_persona =='direccion_firma')
                        cargo_persona = $('#cargo_x_edit').val();
                    if(tipo_persona=='direccion_firma')
                    {
                        $('#edit_persona').modal('hide');
                        //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla

                        $('#nombre_persona_direccion_firma' + id_filapersona).val(nombre_persona);
                        $('#dni_persona_direccion_firma' + id_filapersona).val(dni_persona);
                        $('#cargo_persona_direccion_firma' + id_filapersona).val(cargo_persona);

                        //Enviamos los valores recuperados anteriormente del modal, a los textos visibles de la tabla
                        $('#apellido_persona_text_direccion_firma' + id_filapersona).text(apellido_persona);
                        $('#nombre_persona_text_direccion_firma' + id_filapersona).text(nombre_persona);
                        $('#dni_persona_text_direccion_firma' + id_filapersona).text(dni_persona);
                        $('#cargo_persona_text_direccion_firma' + id_filapersona).text(cargo_persona);

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Persona Modificada',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        });
                    }
                    else
                    {

                        //Ocultamos el modal
                        $('#edit_persona').modal('hide');
                        switch(tipo_persona)
                        {
                            case 'miembro':
                                //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla

                                $('#apellido_persona_miembro' + id_filapersona).val(apellido_persona);

                                $('#nombre_persona_miembro' + id_filapersona).val(nombre_persona);
                                $('#dni_persona_miembro' + id_filapersona).val(dni_persona);

                                //Enviamos los valores recuperados anteriormente del modal, a los textos visibles de la tabla
                                $('#apellido_persona_text_miembro' + id_filapersona).text(apellido_persona);
                                $('#nombre_persona_text_miembro' + id_filapersona).text(nombre_persona);
                                $('#dni_persona_text_miembro' + id_filapersona).text(dni_persona);

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Persona Modificada',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    toast: true

                                });
                            break;
                            case 'apoderado':
                                //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla

                                $('#apellido_persona_apoderado' + id_filapersona).val(apellido_persona);

                                $('#nombre_persona_apoderado' + id_filapersona).val(nombre_persona);
                                $('#dni_persona_apoderado' + id_filapersona).val(dni_persona);

                                //Enviamos los valores recuperados anteriormente del modal, a los textos visibles de la tabla
                                $('#apellido_persona_text_apoderado' + id_filapersona).text(apellido_persona);
                                $('#nombre_persona_text_apoderado' + id_filapersona).text(nombre_persona);
                                $('#dni_persona_text_apoderado' + id_filapersona).text(dni_persona);

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Persona Modificada',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    toast: true

                                });
                            break;
                        }
                    }
                    applyInputMaskDni($("#dni_x_edit"), '0.000.000');
                }
                else
                {
                    //Si alguno de los campos obligatorios esta vacio, detenemos el envio de los datos.
                    event.preventDefault();
                }
            }
            //Obtenemos el numero de la fila que queremos modificar
            var id_fila_denominacion = $("#numero_fila_denominacion").val();
            if(id_fila_denominacion!='')
            {
                //Recuperamos el valor del campo del modal
                var modal_denominacion = $("#denominacion_edit").val();

                //Si el campo obligatorio NO esta vacio, permite enviar el nuevo valore a la tabla
                if(modal_denominacion != ''){

                    //Ocultamos el modal
                    $('#modal_denominaciones').modal('hide');

                    //Enviamos el valor recuperado anteriormente del modal, al input de la tabla
                    $('#denominacion' + id_fila_denominacion).val(modal_denominacion);

                    //Enviamos el valor recuperado anteriormente del modal, al texto visible de la tabla

                    $('#denominacion_text' + id_fila_denominacion).text(modal_denominacion);
                    ocultarError($('#denominacion_edit'), '#small-denominacion-head');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Denominación Modificada',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true

                    })

                }
                else
                {

                    //Si el campo obligatorio esta vacio, detenemos el envio del dato.
                    event.preventDefault();
                    mostrarError($("#denominacion_edit"), '#small-denominacion-edit', '<p style="color:red;">La DENOMICACIÓN de la firma nacional o extranjera que representa <strong>no</strong> puede quedar vacía.</p>');
                }
            }
            //Obtenemos el numero de la fila que queremos modificar
            var id_fila_banco= $("#numero_fila_banco").val();
            if(id_fila_banco!='')
            {
                //Recuperamos el valor del campo del modal
                var nombre_banco = $("#nombre_banco_edit").val();
                var tipo_cuenta = $("#tipo_cuenta_edit").val();
                var provincia_sucursal = $("#provincia_sucursal_edit").val();
                var localidad_sucursal = $("#localidad_sucursal_edit").val();
                var nro_cuenta = $("#nro_cuenta_edit").val();
                console.log('"nombre de banco ='+nombre_banco+' tipo cuenta ='+tipo_cuenta+' provincia = '+provincia_sucursal+' localidad = '+ localidad_sucursal + 'nro cuenta = '+nro_cuenta);
                //Si el campo obligatorio NO esta vacio, permite enviar el nuevo valore a la tabla
                if(nombre_banco != '' && tipo_cuenta != '' && localidad_sucursal != '' && nro_cuenta != '')
                {
                    //Ocultamos el modal
                    $('#modal_banco').modal('hide');

                    //Enviamos el valor recuperado anteriormente del modal, al input de la tabla
                    $('#nombre_banco' + id_fila_banco).val(nombre_banco);
                    $('#provincia_sucursal' + id_fila_banco).val(provincia_sucursal);
                    $('#localidad_sucursal' + id_fila_banco).val(localidad_sucursal);
                    $('#tipo_cuenta' + id_fila_banco).val(tipo_cuenta);
                    $('#nro_cuenta' + id_fila_banco).val(nro_cuenta);

                    //Enviamos el valor recuperado anteriormente del modal, al texto visible de la tabla

                    $('#nombre_banco_text' + id_fila_banco).text(nombre_banco);
                    $('#sucursal_text' + id_fila_banco).text($("#localidad_sucursal_edit option:selected").text());
                    $('#tipo_cuenta_text' + id_fila_banco).text(tipo_cuenta);
                    $('#nro_cuenta_text' + id_fila_banco).text(nro_cuenta);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Referencia bancaria modificada',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true
                    })
                    ocultarError($('#nombre_banco_edit'), '#small-banco-edit');
                    ocultarError($('#tipo_cuenta_edit'), '#small-tipo-cuenta-edit');
                    ocultarError($('#localidad_sucursal_edit'), '#small-localidad-sucursal-edit');
                    ocultarError($('#nro_cuenta_edit'), '#small-nro-cuenta-edit');
                }
                else
                {

                    //Si el campo obligatorio esta vacio, detenemos el envio del dato.
                    event.preventDefault();
                    if($("#nombre_banco_edit").val()=='')
                    {
                        $("#nombre_banco_create").parents('.form-group').find('.select2-selection').css('border', '1px solid red');
                        mostrarError($("#nombre_banco_edit"), '#small-banco-edit', '<p style="color:red;">El NOMBRE DEL BANCO DE REFERENCIA <strong>no</strong> puede quedar vacío.</p>');
                    }
                    if($("#tipo_cuenta_edit").val()=='')
                        mostrarError($("#tipo_cuenta_edit"), '#small-tipo-cuenta-edit', '<p style="color:red;">El TIPO DE CUENTA <strong>no</strong> puede quedar vacío.</p>');
                    if($("#localidad_sucursal_edit").val()=='')
                    {
                        $("#localidad_sucursal_create").parents('.form-group').find('.select2-selection').css('border', '1px solid red');
                        mostrarError($("#sucursal_edit"), '#small-localidad-sucursal-edit', '<p style="color:red;">La LOCALIDAD DE SUCURSAL <strong>no</strong> puede quedar vacío.</p>');
                    }
                    if($("#nro_cuenta_edit").val()=='')
                        mostrarError($("#nro_cuenta_edit"), '#small-nro-cuenta-edit', '<p style="color:red;">El NRO DE CUENTA <strong>no</strong> puede quedar vacío.</p>');
                }
            }
        });



        $(document).on("click", ".btn_cancel_modal", function(event) {
            ocultarError($('#dni_x_edit'), '#small-dni-x-edit');
            ocultarError($('#apellido_x_edit'), '#small-apellido-x-edit');
            ocultarError($('#nombre_x_edit'), '#small-nombre-x-edit');
            ocultarError($('#cargo_x_edit'), '#small-cargo-x-edit');
            $("#div_cargo_x_edit").hide();

            ocultarError($('#denominacion_edit'), '#small-denominacion-edit');

            $("#nombre_banco_edit").parents('.form-group').find('.select2-selection').css('border', '1px solid #ccc');
            ocultarError('#nombre_banco_edit', '#small-banco-edit');
            $("#localidad_sucursal_edit").parents('.form-group').find('.select2-selection').css('border', '1px solid #ccc');
            ocultarError('#localidad_sucursal_edit', '#small-localidad-sucursal-edit');
            ocultarError('#tipo_cuenta_edit', '#small-tipo-cuenta-edit');
            ocultarError('#nro_cuenta_edit', '#small-nro-cuenta-edit');
        });

        $('#edit_persona').on('hidden.bs.modal', function (event) {
            ocultarError($('#dni_x_edit'), '#small-dni-x-edit');
            ocultarError($('#apellido_x_edit'), '#small-apellido-x-edit');
            ocultarError($('#nombre_x_edit'), '#small-nombre-x-edit');
            ocultarError($('#cargo_x_edit'), '#small-cargo-x-edit');
            $("#div_cargo_x_edit").hide();
        });

        $('#modal_denominaciones').on('hidden.bs.modal', function (event) {
            ocultarError($('#denominacion_edit'), '#small-denominacion-edit');
        });

        $('#modal_banco').on('hidden.bs.modal', function (event) {
            $("#nombre_banco_edit").parents('.form-group').find('.select2-selection').css('border', '1px solid #ccc');
            ocultarError('#nombre_banco_edit', '#small-banco-edit');
            $("#localidad_sucursal_edit").parents('.form-group').find('.select2-selection').css('border', '1px solid #ccc');
            ocultarError('#localidad_sucursal_edit', '#small-localidad-sucursal-edit');
            ocultarError('#tipo_cuenta_edit', '#small-tipo-cuenta-edit');
            ocultarError('#nro_cuenta_edit', '#small-nro-cuenta-edit');
        });
    });

    function recargarListaDomicilio(provincia_selected, select_localidad){
        $.ajax({
            type:"GET",
            url:"{{url('localidades')}}/"+provincia_selected,
            success:function(r){
                select_localidad.html(r);
            }
        });
    }

    function recargarListaHabilitacion(){
        $.ajax({
        type:"GET",
                url:"{{url('localidades')}}/"+$('#provincia_habilitacion').val(),

        success:function(r){
            $('#localidad_habilitacion').html(r);
        }
        });


    }

    </script>
    <script type="text/javascript">

        var cant_filas_actividad = document.getElementById("body_table_actividad").rows.length;

        if(cant_filas_actividad == 0)
            $("#body_table_actividad").append(
                '<tr id="row_actividad" class="alert alert-light" role="alert">'+
                    '<td></td>'+
                    '<td>No hay registros</td>'+
                    '<td></td>'+
                '</tr>');

        var cant_filas_banco = document.getElementById("body_table_banco").rows.length;

        if(cant_filas_banco == 0)
            $("#body_table_banco").append(
                '<tr id="row_banco" class="alert alert-light" role="alert">'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td>No hay registros</td>'+
                    '<td></td>'+
                    '<td></td>'+
                '</tr>');

    </script>



@endpush


@push('css')
    <style>
        .progress-bar {
            background-color: #17a2b8;
            color: #000;
        }

        input:invalid:required {

            border: 1px dashed red;
        }

        select:required {

            border: 1px dashed red;
        }

        input:hover:invalid:required {

            background-color: rgb(255, 76, 76);
        }

    </style>

@endpush
