<fieldset>
    <div class="row">
        <h1>Sucursales</h1>
    </div>

    <br />

    <label for="nombre_sucursal">Nombre Sucursal:</label><br />
    <input type="text" class="form-control" placeholder="Ingrese el nombre de la sucursal" aria-describedby="basic-addon1" id="nombre_sucursal" maxlength="50"/><br />

    <div class="row">
        <div class="col-sm">
            <label for="calle_sucursal">Calle:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese la calle" aria-describedby="basic-addon1" id="calle_sucursal" maxlength="40"/><br />

            <label for="dpto_sucursal">Departamento:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto_sucursal" maxlength="10"/><br />

            <label for="lote_sucursal">Lote:</label><br />
            <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote_sucursal" name="lotes[]" maxlength="3"/><br />

            <label for="entre_calles_sucursal">Entre Calles:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entre_calles_sucursal" maxlength="50"/><br />

            <label for="monoblock_sucursal">Monoblock:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock_sucursal" name="monoblocks[]" maxlength="10"/><br />

            <label for="pais_sucursal">Pais:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="pais_sucursal" name="pais_sucursal">
                    @forelse($paises as $pais)
                        <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

            <label for="localidad_sucursal">Localidad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="localidad_sucursal" name="localidad_sucursal">
                    <option value=" ">Seleccione una localidad</option>
                </select>
                <br>

                <label for="email_sucursal">Correo electrónico:</label><br>
                <input id="email_sucursal" type="email" class="form-control email_sucursal" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" maxlength="30"><br>
                <div class="field_email_sucursal">

                </div>
        </div>

        <div class="col-sm">
            <label for="numero_sucursal">Número:</label><br />
            <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero_sucursal" maxlength="4"/><br />

            <label for="puerta_sucursal">Puerta:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese la puerta" aria-describedby="basic-addon1" id="puerta_sucursal" name="puertas[]" maxlength="4"/><br />

            <label for="manzana_sucursal">Manzana:</label><br />
            <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana_sucursal" name="manzanas[]" maxlength="3"/><br />

            <label for="oficina_sucursal">Oficina:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina_sucursal" name="oficinas[]" maxlength="4"/><br />

            <label for="barrio_sucursal">Barrio:</label><br />
            <input type="text" class="form-control" placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio_sucursal" maxlength="20"/><br />

            <label for="provincia_sucursal">Provincia:</label><br>
            <select class="form-control" aria-describedby="basic-addon1" id="provincia_sucursal" name="provincia_sucursal">
                <option value=" ">Seleccione una provincia</option>
                @forelse($provincias as $provincia)
                    <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                @empty
                    <option value=" "></option>
                @endforelse
            </select>
            <br>

            <label for="codigo_postal_sucursal">Código Postal:</label><br>
            <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="codigo_postal_sucursal" name="codigo_postal" placeholder="Ingrese el código postal" maxlength="4"><br>

            <label for="telefono_sucursal">Teléfono:</label><br>
            <input type="text" onkeypress="return valideKey(event);" id="telefono_sucursal" onkeypress="return valideKey(event);" class="form-control telefono_sucursal" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" maxlength="14">
            <!--    <div class="field_telefono_sucursal d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="javascript:void(0);" class="add_telefono_sucursal" title="Agregue un nuevo teléfono"><input type="button" value="Agregar Teléfono" class="btn btn-success"></a>
                </div> -->
            <br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a id="add_sucursal" class="btn btn-success">Agregar Sucursal</a>
            </div>
            <br>
        </div>
    </div>

    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nombre sucursal</th>
                    <th>Correo electrónico</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="body_table_sucursal"></tbody>
        </table>
    </div>

    <br />

    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />


    <!--Incluimos el modal para editar los campos -->

    @include('modales.editarSucursal')

</fieldset>


@push('js')

<script type="text/javascript">

    let nombre_sucursal;
    let email;
    let telefono;
    let calle;
    let numero;
    let departamento;
    let puerta;
    let lote;
    let manzana;
    let entre_calle;
    let oficina;
    let monoblock;
    let barrio;
    let codigo_postal;
    let pais;
    let provincia;
    let localidad_sucursal;
    let i_sucursal = 1; //contador para asignar id al boton que borrara la fila

    $("#add_sucursal").on("click", function(e) {

        //Campos que se muestran en la tabla
        nombre_sucursal = $("#nombre_sucursal").val();
        email = $("#email_sucursal").val();
        telefono = $("#telefono_sucursal").val();

        //Campos ocultos (hidden)
        calle = $("#calle_sucursal").val();
        numero = $("#numero_sucursal").val();
        departamento = $("#dpto_sucursal").val();
        puerta = $("#puerta_sucursal").val();
        lote = $("#lote_sucursal").val();
        manzana = $("#manzana_sucursal").val();
        entre_calle = $("#entre_calles_sucursal").val();
        oficina = $("#oficina_sucursal").val();
        monoblock = $("#monoblock_sucursal").val();
        barrio = $("#barrio_sucursal").val();
        codigo_postal = $("#codigo_postal_sucursal").val();
        pais = $("#pais_sucursal").val();
        provincia = $("#provincia_sucursal").val();
        localidad_sucursal = $("#localidad_sucursal").val();
        /*console.log(pais);
        console.log(provincia);
        console.log(localidad_sucursal);*/


      /*  let error_encontrado=false;

        nombre_sucursal=$('#nombre_sucursal').val();
        console.log("Nombre sucursal a agregar**"+nombre_sucursal);
        if(nombre_sucursal=''){
            error_encontrado=true;
            console.log("Nombre sucursal"+nombre_sucursal);
            $('#errors').show();
            $('#vinetas_error').append("<li>Para agregar una SUCURSAL debe especificar su NOMBRE.</li>");
            return false;
        }
        calle = $("#calle").val();

        barrio = $("#barrio").val();

        //telefono = $("#nro_tel").val();
        entre_calle = $("#entre_calles").val();

        numero = $("#numero").val();

        departamento = $("#dpto").val();


        let valoresTelefonos = [];
        let telefono = "";
        $('.telefono_sucursal').each(function(){
            telefono = $(this).val();
            if(telefono != '')
                valoresTelefonos.push(telefono);
            else{
                error_encontrado=true;
                $('#errors').show();
                $('#vinetas_error').append("<li>Para agregar una SUCURSAL debe especificar al menos 1 (UN) TELEFONO.</li>");
                return false;
            }
        });

        let telefono_aux = '';

        for(i_sucursal in valoresTelefonos){
            telefono_aux = telefono_aux + valoresTelefonos[i_sucursal] + '/';
        }

        let valoresEmails = [];
        let email = "";
        $('.email_sucursal').each(function(){
            email = $(this).val();
            if(email != '')
                valoresEmails.push(telefono);
            else{
                error_encontrado=true;
                $('#errors').show();
                $('#vinetas_error').append("<li>Para agregar una SUCURSAL debe especificar al menos 1 (UN) EMAIL.</li>");
                return false;
            }
        });

        let email_aux = '';
        for(i_sucursal in valoresEmails){
            email_aux = email_aux + valoresEmails[i_sucursal] + '/';
        }
*/

        //if(!error_encontrado){
            /*$("#body_table_sucursal").append(
                '<tr id="row' + i_sucursal +'">'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="calle' + i_sucursal +'" name="calles[]" readonly value="' + calle +'"></td>'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="barrio' + i_sucursal +'" name="barrios[]" readonly value="' + barrio +'"></td>'+
                    '<td><input type="number"  onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="nro_tel' + i_sucursal +'" name="Telefonos_sucursales[]" value="'+telefono_aux+'" readonly></td>'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="entre_calles' + i_sucursal +'" name="entreCalles[]" readonly value="'+ entre_calle +'"></td>'+
                    '<td><input type="number"  onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="numero' + i_sucursal +'" name="numeros[]" readonly value="'+numero+'"></td>'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="dpto' + i_sucursal +'" name="dptos[]" readonly value="'+ departamento +'"></td>'+
                    '<td><input type="email" class="form-control" aria-describedby="basic-addon1" id="email' + i_sucursal +'" name="correos_electronicos[]" readonly value="'+ email +'"></td>'+
                    '<td><button type="button" name="edit" id="'+ i_sucursal +'" class="btn btn-warning btn-sm btn_edit_sucursal" title="editar sucursal"><i_sucursal class="fas fa-edit"></i></button> <button type="button" name="remove" id="' + i_sucursal +'" class="btn btn-danger btn-sm btn_remove_sucursal" title="quitar sucursal"><i_sucursal class="fas fa-trash"></i></button></td>'+
                '</tr>'
            );*/

            $("#body_table_sucursal").append(
                '<tr id="row_sucursal' + i_sucursal +'">'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="nombre_sucursal' + i_sucursal +'" readonly value="' + nombre_sucursal +'" maxlength="50"/></td>'+
                    '<td><input type="email" class="form-control" aria-describedby="basic-addon1" id="email_sucursal' + i_sucursal +'" name="correos_electronicos[]" readonly value="'+ email +'" maxlength="30"></td>'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="telefono_sucursal' + i_sucursal +'" name="Telefonos_sucursales[]" readonly value="' + telefono +'" maxlength="14"></td>'+
                    '<td>'+
                    '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="calle_sucursal' + i_sucursal +'" name="calles[]" readonly value="' + calle +'">'+
                    '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="numero_sucursal' + i_sucursal +'" name="numeros[]" readonly value="'+numero+'">'+
                    '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="dpto_sucursal' + i_sucursal +'" name="dptos[]" readonly value="'+ departamento +'">'+
                    '<input type="hidden"  class="form-control" aria-describedby="basic-addon1" id="puerta_sucursal' + i_sucursal +'" name="puertas[]" readonly value="'+ puerta +'">'+
                    '<input type="hidden"  class="form-control" aria-describedby="basic-addon1" id="lote_sucursal' + i_sucursal +'" name="lotes[]" readonly value="'+ lote +'">'+
                    '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="manzana_sucursal' + i_sucursal +'" name="manzanas[]" readonly value="'+ manzana +'">'+
                    '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="entre_calles_sucursal' + i_sucursal +'" name="entreCalles[]" readonly value="'+ entre_calle +'">'+
                    '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="oficina_sucursal' + i_sucursal +'" name="oficinas[]" readonly value="'+ oficina +'">'+
                    '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="monoblock_sucursal' + i_sucursal +'" name="monoblocks[]" readonly value="'+ monoblock +'">'+
                    '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="barrio_sucursal' + i_sucursal +'" name="barrios[]" readonly value="' + barrio +'">'+
                    '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="pais_sucursal' + i_sucursal +'" name="paises[]" readonly value="' + pais +'">'+
                    '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="provincia_sucursal' + i_sucursal +'" name="provincias[]" readonly value="' + provincia +'">'+
                    '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="localidad_sucursal' + i_sucursal +'" name="localidades[]" readonly value="' + localidad_sucursal +'">'+
                    '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="codigo_postal_sucursal' + i_sucursal +'" name="codigo_postal" readonly value="' + codigo_postal +'">'+
                    '<button type="button" name="edit" id="'+ i_sucursal +'" class="btn btn-warning btn-sm btn_edit_sucursal" title="editar sucursal"><i_sucursal class="fas fa-edit"></i></button> <button type="button" name="remove" id="' + i_sucursal +'" class="btn btn-danger btn-sm btn_remove_sucursal" title="quitar sucursal"><i_sucursal class="fas fa-trash"></i></button>'+
                    '</td>'+
                '</tr>'
            );


            i_sucursal++;


            //Limpiamos cada campo luego de presionar el botón Agregar Sucursal

            document.getElementById("nombre_sucursal").value = "";
            document.getElementById("calle_sucursal").value = "";
            document.getElementById("numero_sucursal").value = "";
            document.getElementById("dpto_sucursal").value = "";
            document.getElementById("puerta_sucursal").value = "";
            document.getElementById("lote_sucursal").value = "";
            document.getElementById("manzana_sucursal").value = "";
            document.getElementById("entre_calles_sucursal").value = "";
            document.getElementById("oficina_sucursal").value = "";
            document.getElementById("monoblock_sucursal").value = "";
            document.getElementById("barrio_sucursal").value = "";
            document.getElementById("codigo_postal_sucursal").value = "";
            document.getElementById("email_sucursal").value = "";
            document.getElementById("telefono_sucursal").value = "";

            /*if(error_encontrado){
            $('#errors').focus();
            return false;
        }*/

    //}

    });
    $(document).on("click", ".btn_remove_sucursal", function() {

        //cuando da click al boton quitar, obtenemos el id del boton
        let button_id = $(this).attr("id");

        //borra la fila
        $("#row_sucursal" + button_id + "").remove();
    });



    //Cargamos los inputs del modal con los datos de la fila de la tabla

    $(document).on("click", ".btn_edit_sucursal", function() {

        //cuando da click al boton editar, obtenemos el id del boton
        let button_id = $(this).attr("id");

        //Recuperamos los valores de los campos pertenecientes a una fila
        let modal_nombre_sucursal = $("#nombre_sucursal"+ button_id).val();
        let modal_email = $("#email_sucursal"+ button_id).val();
        let modal_telefono = $("#telefono_sucursal"+ button_id).val();
        let modal_calle = $("#calle_sucursal"+ button_id).val();
        let modal_numero = $("#numero_sucursal"+ button_id).val();
        let modal_departamento = $("#dpto_sucursal"+ button_id).val();
        let modal_puerta = $("#puerta_sucursal"+ button_id).val();
        let modal_lote = $("#lote_sucursal"+ button_id).val();
        let modal_manzana = $("#manzana_sucursal"+ button_id).val();
        let modal_entre_calles = $("#entre_calles_sucursal"+ button_id).val();
        let modal_oficina = $("#oficina_sucursal"+ button_id).val();
        let modal_monoblock = $("#monoblock_sucursal"+ button_id).val();
        let modal_barrio = $("#barrio_sucursal"+ button_id).val();
        let modal_codigo_postal = $("#codigo_postal_sucursal"+ button_id).val();
        let modal_pais = $("#pais_sucursal"+ button_id).val();
        let modal_provincia = $("#provincia_sucursal"+ button_id).val();
        let modal_localidad_sucursal = $("#localidad_sucursal"+ button_id).val();

        //Desplegamos el modal
        $('#modal_sucursal').modal('show');

        //Enviamos los valores recuperados anteriormente a los inputs del modal
        $('#modal_nombre_sucursal').val(modal_nombre_sucursal);
        $('#modal_calle_sucursal').val(modal_calle);
        $('#modal_dpto_sucursal').val(modal_departamento);
        $('#modal_lote_sucursal').val(modal_lote);
        $('#modal_entre_calles_sucursal').val(modal_entre_calles);
        $('#modal_monoblock_sucursal').val(modal_monoblock);
        $('#modal_pais_sucursal').val(modal_pais);
        $('#modal_localidad_sucursal').val(modal_localidad_sucursal);
        $('#modal_email_sucursal').val(modal_email);
        $('#modal_numero_sucursal').val(modal_numero);
        $('#modal_puerta_sucursal').val(modal_puerta);
        $('#modal_manzana_sucursal').val(modal_manzana);
        $('#modal_oficina_sucursal').val(modal_oficina);
        $('#modal_barrio_sucursal').val(modal_barrio);
        $('#modal_provincia_sucursal').val(modal_provincia);
        $('#modal_codigo_postal_sucursal').val(modal_codigo_postal);
        $('#modal_telefono_sucursal').val(modal_telefono);
        $('#numero_fila_sucursal').val(button_id);

    });

</script>

<!--
<script type="text/javascript">
$(document).ready(function() {

    let maxField = 3; //Cantidad maxima de campos (emails y telefonos) a agregar
    let addTelefono_sucursal = $('.add_telefono_sucursal');
    let wrapper_telefono_sucursal = $('.field_telefono_sucursal');


    //Nuevo campo html (agregar un nuevo teléfono)
    let fieldHTML_telefono_sucursal = '<div>'+
                             '<br>'+
                                '<label for="telefono_sucursal">Teléfono:</label><br>'+
                                '<input type="number"  onkeypress="return valideKey(event);" class="form-control telefono_sucursal" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" >'+
                                '<a href="javascript:void(0);" class="remove_telefono_sucursal" title="Elimine el teléfono"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                             '<br>'+
                            '</div>';


    let x = 1; //Contador inicial, comienza en 1
    $(addTelefono_sucursal).click(function() {
        if (x < maxField) { //Verifica el numero maximo de campos a agregar, con el limite establecido
            x++; //Incrementa el contador en 1
            $(wrapper_telefono_sucursal).append(fieldHTML_telefono_sucursal); // Agrega un nuevo campo html (telefono)
        }
    });
    $(wrapper_telefono_sucursal).on('click', '.remove_telefono_sucursal', function(e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remueve un campo html (telefono)
        x--; //Decrementa el contador en 1
    });



    let addEmail_sucursal = $('.add_email_sucursal');
    let wrapper_email_sucursal = $('.field_email_sucursal');

    //Nuevo campo html (agregar un nuevo correo)
    let fieldHTML_email_sucursal = '<div>'+
                                '<label for="email_sucursal">Correo electrónico:</label><br>'+
                                '<input type="email" class="form-control email_sucursal" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" >'+
                                '<a href="javascript:void(0);" class="remove_email_sucursal" title="Elimine el correo"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                '<br>'+
                                '<br>'+
                            '</div>';



    let i_sucursal = 1; //Contador inicial, comienza en 1
    $(addEmail_sucursal).click(function() {
        if (i_sucursal < maxField) { //Verifica el numero maximo de campos a agregar, con el limite establecido
            i_sucursal; //Incrementa el contador en 1
            $(wrapper_email_sucursal).append(fieldHTML_email_sucursal); // Agrega un nuevo campo html (correo)
        }
    });
    $(wrapper_email_sucursal).on('click', '.remove_email_sucursal', function(e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remueve un campo html (correo)
       i_sucursal--; //Decrementa el contador en 1
    });
});
</script>
-->

<script type="text/javascript">
	$(document).ready(function(){

		$('#provincia_sucursal').change(function(){
			recargarListaSucursal();
		});
	})
</script>

<script type="text/javascript">
	function recargarListaSucursal(){
		$.ajax({
			type:"GET",
			url:"localidades/"+$('#provincia_sucursal').val(),
			success:function(r){
				$('#localidad_sucursal').html(r);
			}
		});
	}
</script>

@endpush
