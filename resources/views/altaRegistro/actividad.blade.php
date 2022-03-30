<fieldset>
<div class="row">
        <h1>Actividad</h1>
</div>

<br/>
    <label for="facturacion_anual_alcanzada">Facturación anual alcanzada:</label><br>
    <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el monto de la facturación anual alcanzada" aria-describedby="basic-addon1" id="facturacion_anual_alcanzada" name="facturacion_anual_alcanzada" maxlength="9"><br>

    <div class="row">
        <div class="col-sm">
            <label for="tipo_actividad">Tipo de Actividad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="tipo_actividad" name="tipo_actividad">
                    @forelse($tipos_actividades as $tipo_actividad)
                        <option value="{{$tipo_actividad->desc_tipo_actividad}}">{{$tipo_actividad->desc_tipo_actividad}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
            <br />
        </div>

        <div class="col-sm">
            <label for="actividad">Actividad:</label><br>
            <select class="form-control" aria-describedby="basic-addon1" id="actividad" name="actividad">
                @forelse($actividades as $actividad)
                    <option value="{{$actividad->desc_actividad}}">{{$actividad->cod_actividad}} - {{$actividad->desc_actividad}}</option>
                @empty
                    <option value=" "></option>
                @endforelse
            </select>
            <br />

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a id="add_actividad" class="btn btn-success">Agregar Actividad</a>
            </div>
        </div>
    </div>
    <br>

    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tipo de Actividad</th>
                    <th>Actividad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="body_table_actividad"></tbody>
        </table>
    </div>

    <br />

    <hr>

    <label for="rne">Registro Nacional de Establecimientos (RNE) N°:</label><br>
    <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de RNE" aria-describedby="basic-addon1" id="rne" name="rne" maxlength="8"><br>

    <div class="row">
        <div class="col-sm">
            <label for="producto_elaborado">Producto elaborado:</label><br>
            <input list="productos" name="producto_elaborado" id="producto_elaborado"  class="form-control" placeholder="Ingrese o seleccione el producto que produce" maxlength="30">
            <datalist id="productos">
                @forelse($productos as $producto)
                    <option value="{{$producto->producto_elaborado}}">
                @empty
                    <option value=" ">
                @endforelse
            </datalist>
            <br>

            <label for="rnpa">RNPA:</label><br>
            <input type="text" class="form-control" aria-describedby="basic-addon1" id="rnpa"
            name="rnpa" placeholder="Ingrese el RNPA" maxlength="8"><br>
        </div>

        <div class="col-sm">
            <label for="unidad_producida">Unidad producida:</label><br>
            <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="unidad_producida" name="unidad_producida" placeholder="Ingrese la cantidad de unidades producidas" maxlength="9"><br>

            <label for="produccion_total">Capacidad de producción total:</label><br>
            <input type="text" onkeypress="return valideKey(event);" class="form-control" aria-describedby="basic-addon1" id="produccion_total" name="produccion_total" placeholder="Ingrese la producción total" maxlength="9"><br>

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a id="add_producto" class="btn btn-success">Agregar Producto</a>
            </div>
        </div>
    </div>
    <br>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Unidades producidas</th>
                    <th>RNPA</th>
                    <th>Capacidad producción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="body_table_producto"></tbody>
        </table>
    </div>

    <br />

    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

    <!--Incluimos el modal para validar una actividad -->

    @include('modales.validarActividad')

    <!--Incluimos el modal para editar un producto -->

    @include('modales.editarProducto')

    <!--Incluimos el modal para validar un producto -->

    @include('modales.validarProducto')

@push('js')




    <script type="text/javascript">

        let tipo_actividad;
        let actividad;
        let codigo_actividad;
        let m = 1; //contador para asignar id al boton que borrara la fila
        let contador = 0; //Contador para llevar el registro de la cantidad de actividades principales agregadas.

        $("#add_actividad").on("click", function(e) {

            tipo_actividad = $("#tipo_actividad").val();
            //Valor que se almacena en el array del input y que se envia a la BD (actividad)
            actividad = $("#actividad").val();
            //Valor que se muestra solamente en el texto de la tabla (cod + actividad)
            codigo_actividad = $('#actividad option:selected').html();

            if(tipo_actividad == 'Primaria'){

                contador++;
            }

            if(tipo_actividad != 'Primaria' || contador <= 1){

                //borra la fila con el mensaje vacio
                $("#row_actividad").remove();

                $("#body_table_actividad").append(
                    '<tr id="row_actividad' + m +'">'+
                        '<td>' + tipo_actividad +'</td>'+
                        '<td>' + codigo_actividad +'</td>'+
                        '<td>'+
                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="tipo_actividad' + m +'" name="tipos_actividades[]" readonly value="' + tipo_actividad +'">'+
                        '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="actividad' + m +'" name="actividades[]" readonly value="' + actividad +'">'+
                        '<button type="button" name="remove" id="' + m +'" class="btn btn-danger btn-sm btn_remove_actividad" title="quitar actividad"><i class="fas fa-trash"></i></button>'+
                        '</td>'+
                    '</tr>'
                );

                m++;

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Actividad Guardada',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true

                })

            }else{

                //Desplegamos el modal
                $('#modal_validar_actividad').modal('show');

            }
        });


        $(document).on("click", ".btn_remove_actividad", function() {

            //cuando da click al boton quitar, obtenemos el id del boton
            let button_id = $(this).attr("id");

            //Obtenemos el tipo de actividad (valor) de la fila que se va a eliminar
            var valor_tipo = $("#tipo_actividad" + button_id + "").val();

            //Si el valor es Primaria, se setea el contador a 0 para que permita volver a agregar una nueva actividad primaria. En caso de que sea Secundaria, solamente borra la fila sin setear el contador para que no permita agregar mas de una actividad principal.
            if(valor_tipo == 'Primaria'){
                contador = 0;
            }

            //borra la fila
            $("#row_actividad" + button_id + "").remove();

            Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Actividad dada de baja',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true

                })

                var cant_filas_actividad = document.getElementById("body_table_actividad").rows.length;

                /*Si al eliminar una fila, la tabla esta vacia, volvemos a mostrar el mensaje de aviso*/
                if(cant_filas_actividad == 0){

                    $("#body_table_actividad").append(
                        '<tr id="row_actividad" class="alert alert-light" role="alert">'+
                            '<td></td>'+
                            '<td>No hay registros</td>'+
                            '<td></td>'+
                        '</tr>'
                    );
                }

        });

    </script>



<script type="text/javascript">

let producto_elaborado;
let unidad_producida;
let rnpa;
let produccion_total;
let n = 1; //contador para asignar id al boton que borrara la fila

$("#add_producto").on("click", function(e) {

    producto_elaborado = $("#producto_elaborado").val();
    unidad_producida = $("#unidad_producida").val();
    rnpa = $("#rnpa").val();
    produccion_total = $("#produccion_total").val();

    //Obtenemos los campos obligatorios para aplicarles estilos css
    let producto_elaborado_css = document.getElementById("producto_elaborado");
    let unidad_producida_css = document.getElementById("unidad_producida");


    if(producto_elaborado.length != 0 && unidad_producida.length != 0){

        //borra la fila con el mensaje vacio
        $("#row_producto").remove();

        $("#body_table_producto").append(
            '<tr id="row_producto' + n +'">'+
                '<td> <div id="producto_elaborado_text' + n +'">' + producto_elaborado +'</div></td>'+
                '<td> <div id="unidad_producida_text' + n +'">' + unidad_producida +'</div></td>'+
                '<td> <div id="rnpa_text' + n +'">' + rnpa +'</div></td>'+
                '<td> <div id="produccion_total_text' + n +'">' + produccion_total +'</div></td>'+
                '<td>'+
                '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="producto_elaborado' + n +'" name="productos[]" readonly value="' + producto_elaborado +'">'+
                '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="unidad_producida' + n +'" name="unidades[]" readonly value="' + unidad_producida +'">'+
                '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="rnpa' + n +'" name="rnpas[]" readonly value="' + rnpa +'">'+
                '<input type="hidden" class="form-control" aria-describedby="basic-addon1" id="produccion_total' + n +'" name="producciones[]" readonly value="' + produccion_total +'">'+
                '<button type="button" name="edit" id="'+ n +'" class="btn btn-warning btn-sm btn_edit_producto" title="editar producto"><i class="fas fa-edit"></i></button> <button type="button" name="remove" id="' + n +'" class="btn btn-danger btn-sm btn_remove_producto" title="quitar producto"><i class="fas fa-trash"></i></button>'+
                '</td>'+
            '</tr>'
        );

        n++;

        //Limpiamos cada campo luego de presionar el botón Agregar vehículo

        document.getElementById("producto_elaborado").value = "";
        document.getElementById("unidad_producida").value = "";
        document.getElementById("rnpa").value = "";
        document.getElementById("produccion_total").value = "";


        producto_elaborado_css.style.border = '1px solid #DFDFDF';
        unidad_producida_css.style.border = '1px solid #DFDFDF';

        Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Producto Guardado',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true

        })


    } else {

        if(producto_elaborado.length == 0){

            producto_elaborado_css.style.border = '2px dashed red';
        }

        if(unidad_producida.length == 0){

            unidad_producida_css.style.border = '2px dashed red';
        }


        /*Definir bien cuales campos deben ser requeridos y luego mostrar un mensaje en un modal*/
        //Desplegamos el modal
        $('#modal_validar_producto').modal('show');

    }

});


$(document).on("click", ".btn_remove_producto", function() {

    //cuando da click al boton quitar, obtenemos el id del boton
    let button_id = $(this).attr("id");

    //borra la fila
    $("#row_producto" + button_id + "").remove();

    Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Producto dado de baja',
                showConfirmButton: false,
                timer: 1500,
                toast: true

    })

    var cant_filas_producto = document.getElementById("body_table_producto").rows.length;

    /*Si al eliminar una fila, la tabla esta vacia, volvemos a mostrar el mensaje de aviso*/
    if(cant_filas_producto == 0){

        $("#body_table_producto").append(
                '<tr id="row_producto" class="alert alert-light" role="alert">'+
                    '<td></td>'+
                    '<td></td>'+
                    '<td>No hay registros</td>'+
                    '<td></td>'+
                    '<td></td>'+
                '</tr>'
        );
    }

});


//Cargamos los inputs del modal con los datos de la fila de la tabla

$(document).on("click", ".btn_edit_producto", function() {

    //cuando da click al boton editar, obtenemos el id del boton
    let button_id = $(this).attr("id");

    //Recuperamos los valores de los campos pertenecientes a una fila
    let modal_producto_elaborado = $("#producto_elaborado"+ button_id).val();
    let modal_unidad_producida = $("#unidad_producida"+ button_id).val();
    let modal_rnpa = $("#rnpa"+ button_id).val();
    let modal_produccion_total = $("#produccion_total"+ button_id).val();

    //Desplegamos el modal
    $('#modal_producto').modal('show');

    //Enviamos los valores recuperados anteriormente a los inputs del modal
    $('#modal_producto_elaborado').val(modal_producto_elaborado);
    $('#modal_unidad_producida').val(modal_unidad_producida);
    $('#modal_rnpa').val(modal_rnpa);
    $('#modal_produccion_total').val(modal_produccion_total);
    $('#numero_fila_producto').val(button_id);

});

</script>

@endpush

</fieldset>
