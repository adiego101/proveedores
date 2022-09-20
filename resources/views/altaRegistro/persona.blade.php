<fieldset>
    @switch($tipo_persona)
        @case ('miembro')
            <h1>Personas Físicas / Sucesiones indivisas / Sociedades de Hecho / S.A.S <sup>*</sup></h1>
            <p><sup>*</sup>Las sociedades detalladas deberán mencionar sus integrantes</p>
        @break
        @case ('direccion_firma')
            <h1>Miembros de los órganos de dirección y administración de firma<sup>*</sup></h1>
            <p><sup>*</sup>Sólo para personas jurídicas</p>
        @break
        @case ('apoderado')
            <h1>Apoderado/s de firma</h1>
        @break
    @endswitch
    <br>
    @include('personas.form', ['mode'=>'create'])

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a id="add_persona_{{$tipo_persona}}" class="btn btn-success" data-tipo-persona="{{$tipo_persona}}">Agregar Persona</a>
    </div>
    <br>

    <div>
        <table class="table table-hover" id="personas_{{$tipo_persona}}">
            <thead>
                <tr>
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    @if($tipo_persona=='direccion_firma')
                        <th>Cargo</th>
                    @endif
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="body_table_persona_{{$tipo_persona}}"></tbody>
        </table>
    </div>

    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

</fieldset>

@push('js')

    <script type="text/javascript">

        var cant_filas_persona = $("#body_table_persona_{{$tipo_persona}} > tr").length;
        var cant_columnas_persona = $("#personas_{{$tipo_persona}} > thead> tr > th").length;

        if(cant_filas_persona == 0)
            $("#body_table_persona_{{$tipo_persona}}").append(
                '<tr id="row_persona_{{$tipo_persona}}" class="alert alert-light" role="alert">No hay registros'+
                '<td colspan="'+cant_columnas_persona+'" align="center">No hay registros</td>'+
                '</tr>');

    </script>

    <script type="text/javascript">        

        $("#add_persona_{{$tipo_persona}}").on("click", function(event) {
            event.stopImmediatePropagation();
            let dni_persona = $('#dni_{{$tipo_persona}}_{{$mode}}').val();
            let apellido_persona = $('#apellido_{{$tipo_persona}}_{{$mode}}').val();
            let nombre_persona = $('#nombre_{{$tipo_persona}}_{{$mode}}').val();
            let tipo_persona = $(this).data('tipo-persona');
            let cargo_persona='';
            if(tipo_persona =='direccion_firma')
                cargo_persona = $('#cargo_{{$tipo_persona}}_{{$mode}}').val();

            //Obtenemos los campos obligatorios para aplicarles estilos css
            if(dni_persona!='' && apellido_persona!='' && nombre_persona!='')
            {
                if(tipo_persona=='direccion_firma')
                    if(cargo_persona!='')
                    {
                        //borra la fila con el mensaje vacio
                        $("#row_persona_{{$tipo_persona}}").remove();

                        $("#body_table_persona_{{$tipo_persona}}").append(
                            '<tr id="row_persona' + indice + '">' +
                                '<td> <div id="apellido_persona_text_{{$tipo_persona}}' + indice + '">' + apellido_persona +'</div></td>'+
                                '<td> <div id="nombre_persona_text_{{$tipo_persona}}' + indice + '">' + nombre_persona +'</div></td>'+
                                '<td> <div id="dni_persona_text_{{$tipo_persona}}' + indice + '">' + dni_persona +'</div></td>'+
                                '<td> <div id="cargo_persona_text_{{$tipo_persona}}' + indice + '">' + cargo_persona +'</div></td>'+
                                '<td>'+
                                '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="apellido_persona_{{$tipo_persona}}' + indice + '" name="apellidos_persona_{{$tipo_persona}}[]" readonly value="' + apellido_persona + '">' +
                                '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="nombre_persona_{{$tipo_persona}}' + indice + '" name="nombres_persona_{{$tipo_persona}}[]" readonly value="' + nombre_persona + '">' +
                                '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="dni_persona_{{$tipo_persona}}' + indice + '" name="dnis_persona_{{$tipo_persona}}[]" readonly value="' + dni_persona + '">' +
                                '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="cargo_persona_{{$tipo_persona}}' + indice + '" name="cargos_persona_{{$tipo_persona}}[]" readonly value="' + cargo_persona + '">' +
                                '<button type="button" name="edit" id="' + indice + '" class="btn btn-warning btn-sm btn_edit_persona" title="editar persona" data-tipo-persona="'+tipo_persona+'"><indice class="fas fa-edit"></i></button>' +
                                '<button type="button" name="remove" id="' + indice + '" class="btn btn-danger btn-sm btn_remove_persona" title="quitar persona"><indice class="fas fa-trash"></i></button>' +
                                '</td>' +
                            '</tr>'
                        );

                        indice++;

                        //Limpiamos cada campo luego de presionar el botón Agregar Pago

                        $('#dni_{{$tipo_persona}}_{{$mode}}').val('');
                        $('#apellido_{{$tipo_persona}}_{{$mode}}').val('');
                        $('#nombre_{{$tipo_persona}}_{{$mode}}').val('');
                        $('#cargo_{{$tipo_persona}}_{{$mode}}').val('');

                        $('#apellido_{{$tipo_persona}}_{{$mode}}').css('border', '1px solid #DFDFDF');
                        $('#nombre_{{$tipo_persona}}_{{$mode}}').css('border', '1px solid #DFDFDF');
                        $('#dni_{{$tipo_persona}}_{{$mode}}').css('border', '1px solid #DFDFDF');
                        $('#cargo_{{$tipo_persona}}_{{$mode}}').css('border', '1px solid #DFDFDF');

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Pago Guardado',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                        })
                    }
                    else
                    {
                        if(cargo_persona=='')
                            $('#cargo_direccion_firma_edit').css('border', '2px dashed red');
                    }
                else
                {
                    console.log("pasa por ak ++");
                    //borra la fila con el mensaje vacio
                    $("#row_persona_{{$tipo_persona}}").remove();

                    $("#body_table_persona_{{$tipo_persona}}").append(
                        '<tr id="row_persona_{{$tipo_persona}}' + indice + '">' +
                            '<td> <div id="apellido_persona_text_{{$tipo_persona}}' + indice + '">' + apellido_persona +'</div></td>'+
                            '<td> <div id="nombre_persona_text_{{$tipo_persona}}' + indice + '">' + nombre_persona +'</div></td>'+
                            '<td> <div id="dni_persona_text_{{$tipo_persona}}' + indice + '">' + dni_persona +'</div></td>'+
                            '<td>'+
                            '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="apellido_persona_{{$tipo_persona}}' + indice + '" name="apellidos_persona_{{$tipo_persona}}[]" readonly value="' + apellido_persona + '">' +
                            '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="nombre_persona_{{$tipo_persona}}' + indice + '" name="nombres_persona_{{$tipo_persona}}[]" readonly value="' + nombre_persona + '">' +
                            '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="dni_persona_{{$tipo_persona}}' + indice + '" name="dnis_persona_{{$tipo_persona}}[]" readonly value="' + dni_persona + '">' +
                            '<button type="button" name="edit" id="' + indice + '" class="btn btn-warning btn-sm btn_edit_persona" title="editar persona" data-tipo-persona="'+tipo_persona+'"><indice class="fas fa-edit"></i></button>' +
                            '<button type="button" name="remove" id="' + indice + '" class="btn btn-danger btn-sm btn_remove_persona" title="quitar persona"><indice class="fas fa-trash"></i></button>' +
                            '</td>' +
                        '</tr>'
                    );

                    indice++;

                    //Limpiamos cada campo luego de presionar el botón Agregar Pago

                    $('#dni_{{$tipo_persona}}_{{$mode}}').val('');
                    $('#apellido_{{$tipo_persona}}_{{$mode}}').val('');
                    $('#nombre_{{$tipo_persona}}_{{$mode}}').val('');

                    $('#apellido_{{$tipo_persona}}_{{$mode}}').css('border', '1px solid #DFDFDF');
                    $('#nombre_{{$tipo_persona}}_{{$mode}}').css('border', '1px solid #DFDFDF');
                    $('#dni_{{$tipo_persona}}_{{$mode}}').css('border', '1px solid #DFDFDF');

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Pago Guardado',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true

                    })
                }

            } else {
                event.preventDefault();
                //Desplegamos el modal
                $('#modal_validar_persona').modal('show');
            }

        });


        $(document).on("click", ".btn_remove_persona", function() {

            //cuando da click al boton quitar, obtenemos el id del boton
            let button_id = $(this).attr("id");

            //borra la fila
            $("#row_persona_{{$tipo_persona}}" + button_id + "").remove();

            Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Persona dada de baja',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true

            })

            var cant_filas_persona = $("#body_table_persona_{{$tipo_persona}} > tr").length;
            var cant_columnas_persona = $("#personas_{{$tipo_persona}} > thead> tr > th").length;
            if(cant_filas_persona == 0){

                $("#body_table_persona_{{$tipo_persona}}").append(
                '<tr id="row_persona_{{$tipo_persona}}" class="alert alert-light" role="alert">No hay registros'+
                '<td colspan="'+cant_columnas_persona+'" align="center">No hay registros</td>'+
                '</tr>');
            }
        });


        //Cargamos los inputs del modal con los datos de la fila de la tabla

        $(document).on("click", ".btn_edit_persona", function(event) {
            event.stopImmediatePropagation();
            let tipo_persona = $(this).data('tipo-persona');
            //cuando da click al boton editar, obtenemos el id del boton
            let button_id = $(this).attr("id");
            //Recuperamos los valores de los campos pertenecientes a una fila
            let apellido_persona='';
            let nombre_persona='';
            let dni_persona='';
            let cargo_persona='';
            switch(tipo_persona)
            {
                case 'miembro':
                    apellido_persona = $("#apellido_persona_miembro" + button_id).val();
                    nombre_persona = $("#nombre_persona_miembro" + button_id).val();
                    dni_persona = $("#dni_persona_miembro" + button_id).val();
                break;
                case 'direccion_firma':
                    apellido_persona = $("#apellido_persona_direccion_firma" + button_id).val();
                    nombre_persona = $("#nombre_persona_direccion_firma" + button_id).val();
                    dni_persona = $("#dni_persona_direccion_firma" + button_id).val();
                    cargo_persona = $("#cargo_persona_direccion_firma" + button_id).val();
                break;
                case 'apoderado':
                    apellido_persona = $("#apellido_persona_apoderado" + button_id).val();
                    nombre_persona = $("#nombre_persona_apoderado" + button_id).val();
                    dni_persona = $("#dni_persona_apoderado" + button_id).val();
                break;
            }
            if(tipo_persona=='direccion_firma')
            {
                $('#cargo_x_edit').val(cargo_persona);
               $('#div_cargo_x_edit').show();
            }
            
            //Desplegamos el modal
            $('#edit_persona').modal('show');

            //Enviamos los valores recuperados anteriormente a los inputs del modal
            $('#apellido_x_edit').val(apellido_persona);
            $('#nombre_x_edit').val(nombre_persona);
            $('#dni_x_edit').val(dni_persona);
            $("#numero_fila_persona").val(button_id);
            $(".btn_edit_modal").data('tipo-persona', tipo_persona);
        });
        
        $("#apellido_{{$tipo_persona}}_{{$mode}}").keyup(validarExisteDatosPersona);

        $("#nombre_{{$tipo_persona}}_{{$mode}}").keyup(validarExisteDatosPersona);

        $("#dni_{{$tipo_persona}}_{{$mode}}").keyup(validarExisteDatosPersona);

        $("#cargo_{{$tipo_persona}}_{{$mode}}").keyup(validarExisteDatosPersona);
        
        function validarExisteDatosPersona()
        {
            let tipo_persona=@json($tipo_persona);
            if(tipo_persona == 'direccion_firma')
            {
                tipo_persona = 'miembro de órgano de dirección y administración de firma';
                if($('#cargo_{{$tipo_persona}}_{{$mode}}').val()=='')
                {
                    mostrarError('#cargo_{{$tipo_persona}}_{{$mode}}', '#small-cargo-{{$tipo_persona}}-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El CARGO del '+tipo_persona+' <strong>no</strong> puede quedar vacío.</div>');
                    mostrarError('#cargo_{{$tipo_persona}}_{{$mode}}', '#small-cargo-{{$tipo_persona}}-head', '<div class="alert alert-danger mt-3 pt-1">El CARGO del '+tipo_persona+' <strong>no</strong> puede quedar vacío.</div>');
                }
                else
                {
                    ocultarError('#cargo_{{$tipo_persona}}_{{$mode}}', '#small-cargo-{{$tipo_persona}}-{{$mode}}');
                    ocultarError('#cargo_{{$tipo_persona}}_{{$mode}}', '#small-cargo-{{$tipo_persona}}-head');
                }
            }
            if($('#apellido_{{$tipo_persona}}_{{$mode}}').val()=='')
            {
            mostrarError('#apellido_{{$tipo_persona}}_{{$mode}}', '#small-apellido-{{$tipo_persona}}-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El APELLIDO del '+tipo_persona+' <strong>no</strong> puede quedar vacío.</div>');
            mostrarError('#apellido_{{$tipo_persona}}_{{$mode}}', '#small-apellido-{{$tipo_persona}}-head', '<div class="alert alert-danger mt-3 pt-1">El APELLIDO del '+tipo_persona+' <strong>no</strong> puede quedar vacío.</div>');
            if($("#dni_{{$tipo_persona}}_{{$mode}}").val()=='')
            {
                mostrarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El DNI del '+tipo_persona+' <strong>no</strong> puede quedar vacío.</div>');
                mostrarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}-head', '<div class="alert alert-danger mt-3 pt-1">El DNI del '+tipo_persona+' <strong>no</strong> puede quedar vacío.</div>');
                if($("#nombre_{{$tipo_persona}}_{{$mode}}").val()=='')
                {
                ocultarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}-{{$mode}}');
                ocultarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}-head');
                ocultarError('#apellido_{{$tipo_persona}}_{{$mode}}', '#small-apellido-{{$tipo_persona}}-{{$mode}}');
                ocultarError('#apellido_{{$tipo_persona}}_{{$mode}}', '#small-apellido-{{$tipo_persona}}-head');
                ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-{{$mode}}');
                ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-head');
                return true;
                }
                else
                {
                ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-{{$mode}}');
                ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-head');
                return true;
                }
            }
            else
            {
                
                ocultarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}-{{$mode}}');
                ocultarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}-head');
                validarDni($(this));
                if($("#nombre_{{$tipo_persona}}_{{$mode}}").val()=='')
                {
                mostrarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del '+tipo_persona+' <strong>no</strong> puede quedar vacío.</div>');
                mostrarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-head', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del '+tipo_persona+' <strong>no</strong> puede quedar vacío.</div>');
                return false;
                }
                else
                {
                ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-{{$mode}}');
                ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-head');
                return true;
                }
            }
            }
            else
            {
            ocultarError('#apellido_{{$tipo_persona}}_{{$mode}}', '#small-apellido-{{$tipo_persona}}-{{$mode}}');
            ocultarError('#apellido_{{$tipo_persona}}_{{$mode}}', '#small-apellido-{{$tipo_persona}}-head');
                if($("#dni_{{$tipo_persona}}_{{$mode}}").val()=='')
                {
                    mostrarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El DNI del '+tipo_persona+' <strong>no</strong> puede quedar vacío.</div>');
                    mostrarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}-head', '<div class="alert alert-danger mt-3 pt-1">El DNI del '+tipo_persona+' <strong>no</strong> puede quedar vacío.</div>');
                    if($("#nombre_{{$tipo_persona}}_{{$mode}}").val()=='')
                    {
                    mostrarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del '+tipo_persona+' <strong>no</strong> puede quedar vacío.</div>');
                    mostrarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-head', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del '+tipo_persona+' <strong>no</strong> puede quedar vacío.</div>');
                    return false;
                    }
                    else
                    {
                    ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-{{$mode}}');
                    ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-head');
                    return true;
                    }
                }
                else
                {
                    ocultarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}-{{$mode}}');
                    ocultarError('#dni_{{$tipo_persona}}_{{$mode}}', '#small-dni-{{$tipo_persona}}-head');
                    validarDni($(this));
                    if($("#nombre_{{$tipo_persona}}_{{$mode}}").val()=='')
                    {
                    mostrarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del '+tipo_persona+' <strong>no</strong> puede quedar vacío.</div>');
                    mostrarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-head', '<div class="alert alert-danger mt-3 pt-1">El NOMBRE del '+tipo_persona+' <strong>no</strong> puede quedar vacío.</div>');
                    return false;
                    }
                    else
                    {
                    ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-{{$mode}}');
                    ocultarError('#nombre_{{$tipo_persona}}_{{$mode}}', '#small-nombre-{{$tipo_persona}}-head');
                    return true;
                    }
                }
            }
        }

        function validarDni(dni)
        {
            let tipo_persona = dni.data('tipo-persona');
            console.log("pasa por ak con tipo persona="+tipo_persona);
            let mode = dni.data('mode');
            if(dni.val() != "")
            {   
                switch(tipo_persona)
                {
                    case 'miembro':
                        if(mode=='create')
                        {
                            if (!(/^(\d{1,2}\.{1}\d{3}\.\d{3})|(\d{1,2}\s{1}\d{3}\s\d{3})$/g.test(dni.val()))) 
                            {
                                mostrarError('#dni_miembro_create', '#small-dni-miembro-create', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI de '+tipo_persona+' </strong> tiene un formato incorrecto.</div>');
                                mostrarError('#dni_miembro_create', '#small-dni-miembro-head', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI de '+tipo_persona+' </strong> tiene un formato incorrecto.</div>');
                                return false;
                            }  
                            else
                            {
                                ocultarError('#dni_miembro_create', '#small-dni-miembro-create');
                                ocultarError('#dni_miembro_create', '#small-dni-miembro-head');

                                return true;
                            }
                        }
                        else
                            if(mode=='edit')
                            {
                                if (!(/^(\d{1,2}\.{1}\d{3}\.\d{3})|(\d{1,2}\s{1}\d{3}\s\d{3})$/g.test(dni.val()))) 
                                {
                                    mostrarError('#dni_miembro_edit', '#small-dni-miembro-edit', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI de '+tipo_persona+' </strong> tiene un formato incorrecto.</div>');
                                    mostrarError('#dni_miembro_edit', '#small-dni-miembro-head', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI de '+tipo_persona+' </strong> tiene un formato incorrecto.</div>');
                                    return false;
                                }  
                                else
                                {
                                    ocultarError('#dni_miembro_edit', '#small-dni-miembro-edit');
                                    ocultarError('#dni_miembro_edit', '#small-dni-miembro-head');

                                    return true;
                                }
                            }
                    break;
                    case 'direccion_firma':
                        tipo_persona = 'miembro de órgano de dirección y administración de firma';
                        if(mode=='create')
                        {
                            if (!(/^(\d{1,2}\.{1}\d{3}\.\d{3})|(\d{1,2}\s{1}\d{3}\s\d{3})$/g.test(dni.val()))) 
                            {
                                mostrarError('#dni_direccion_firma_create', '#small-dni-direccion_firma-create', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI de '+tipo_persona+' </strong> tiene un formato incorrecto.</div>');
                                mostrarError('#dni_direccion_firma_create', '#small-dni-direccion_firma-head', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI de '+tipo_persona+' </strong> tiene un formato incorrecto.</div>');
                                return false;
                            }  
                            else
                            {
                                ocultarError('#dni_direccion_firma_create', '#small-dni-direccion_firma-create');
                                ocultarError('#dni_direccion_firma_create', '#small-dni-direccion_firma-head');

                                return true;
                            }
                        }
                        else
                            if(mode=='edit')
                            {
                                if (!(/^(\d{1,2}\.{1}\d{3}\.\d{3})|(\d{1,2}\s{1}\d{3}\s\d{3})$/g.test(dni.val()))) 
                                {
                                    mostrarError('#dni_direccion_firma_edit', '#small-dni-direccion_firma-edit', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI de '+tipo_persona+' </strong> tiene un formato incorrecto.</div>');
                                    mostrarError('#dni_direccion_firma_edit', '#small-dni-direccion_firma-head', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI de '+tipo_persona+' </strong> tiene un formato incorrecto.</div>');
                                    return false;
                                }  
                                else
                                {
                                    ocultarError('#dni_direccion_firma_edit', '#small-dni-direccion_firma-edit');
                                    ocultarError('#dni_direccion_firma_edit', '#small-dni-direccion_firma-head');

                                    return true;
                                }
                            }
                    break;
                    case 'apoderado':
                        if(mode=='create')
                        {
                            if (!(/^(\d{1,2}\.{1}\d{3}\.\d{3})|(\d{1,2}\s{1}\d{3}\s\d{3})$/g.test(dni.val()))) 
                            {
                                mostrarError('#dni_apoderado_create', '#small-dni-apoderado-create', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI de '+tipo_persona+' </strong> tiene un formato incorrecto.</div>');
                                mostrarError('#dni_apoderado_create', '#small-dni-apoderado-head', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI de '+tipo_persona+' </strong> tiene un formato incorrecto.</div>');
                                return false;
                            }  
                            else
                            {
                                ocultarError('#dni_apoderado_create', '#small-dni-apoderado-create');
                                ocultarError('#dni_apoderado_create', '#small-dni-apoderado-head');

                                return true;
                            }
                        }
                        else
                            if(mode=='edit')
                            {
                                if (!(/^(\d{1,2}\.{1}\d{3}\.\d{3})|(\d{1,2}\s{1}\d{3}\s\d{3})$/g.test(dni.val()))) 
                                {
                                    mostrarError('#dni_apoderado_edit', '#small-dni-apoderado-edit', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI de '+tipo_persona+' </strong> tiene un formato incorrecto.</div>');
                                    mostrarError('#dni_apoderado_edit', '#small-dni-apoderado-head', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI de '+tipo_persona+' </strong> tiene un formato incorrecto.</div>');
                                    return false;
                                }  
                                else
                                {
                                    ocultarError('#dni_apoderado_edit', '#small-dni-apoderado-edit');
                                    ocultarError('#dni_apoderado_edit', '#small-dni-apoderado-head');

                                    return true;
                                }
                            }
                    break;
                    case 'x':
                        if(mode=='create')
                        {
                            if (!(/^(\d{1,2}\.{1}\d{3}\.\d{3})|(\d{1,2}\s{1}\d{3}\s\d{3})$/g.test(dni.val()))) 
                            {
                                mostrarError('#dni_x_create', '#small-dni-x-create', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI de la persona </strong> tiene un formato incorrecto.</div>');
                                return false;
                            }  
                            else
                            {
                                ocultarError('#dni_x_create', '#small-dni-x-create');

                                return true;
                            }
                        }
                        else
                            if(mode=='edit')
                            {
                                if (!(/^(\d{1,2}\.{1}\d{3}\.\d{3})|(\d{1,2}\s{1}\d{3}\s\d{3})$/g.test(dni.val()))) 
                                {
                                    mostrarError('#dni_x_edit', '#small-dni-x-edit', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de DNI de la persona </strong> tiene un formato incorrecto.</div>');
                                    return false;
                                }  
                                else
                                {
                                    ocultarError('#dni_x_edit', '#small-dni-x-edit');

                                    return true;
                                }
                            }
                    break;
                }
            }
            else
                return true;
        }

    </script>

@endpush