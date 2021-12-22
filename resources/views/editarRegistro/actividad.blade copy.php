<fieldset>
<div class="row">
        <h1>Actividad</h1>
</div>

<br/>
    <label for="facturacion_anual_alcanzada">Facturación anual alcanzada:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese el monto de la facturación anual alcanzada" aria-describedby="basic-addon1" id="facturacion_anual_alcanzada"
    name="facturacion_anual_alcanzada"
        value="{{ isset($proveedor->facturacion_anual_alcanzada) ? $proveedor->facturacion_anual_alcanzada : '' }}"><br>

    <div class="row">
        <div class="col-sm">
            <!--En este caso, se deben recuperar los tipos de actividad de la BD -->
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

            <!--En este caso, se deben recuperar las actividades de la BD -->
            <label for="actividad">Actividad:</label><br>
            <select class="form-control" aria-describedby="basic-addon1" id="actividad" name="actividad">
                @forelse($actividades as $actividad)
                    <option value="{{$actividad->desc_actividad}}">{{$actividad->desc_actividad}}</option>
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
    <input type="text" class="form-control" placeholder="Ingrese el número de RNE" aria-describedby="basic-addon1" id="rne" name="rne"
        value="{{ isset($proveedor->rne) ? $proveedor->rne : '' }}"><br>

    <div class="row">
        <div class="col-sm">
            <label for="producto_elaborado">Producto elaborado:</label><br>
            <input list="productos" name="producto_elaborado" id="producto_elaborado"  class="form-control" placeholder="Ingrese o seleccione el producto que produce">
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
            name="rnpa" placeholder="Ingrese el RNPA"><br>
        </div>

        <div class="col-sm">
            <label for="unidad_producida">Unidad producida:</label><br>
            <input type="number" class="form-control" aria-describedby="basic-addon1" id="unidad_producida"
            name="unidad_producida" placeholder="Ingrese la cantidad de unidades producidas"><br>

            <label for="produccion_total">Capacidad de producción total:</label><br>
            <input type="number" class="form-control" aria-describedby="basic-addon1" id="produccion_total" name="produccion_total" placeholder="Ingrese la producción total"><br>

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
<div class="row navbuttons pt-5">
    <div class="col-6 col-sm-auto" id="btnPrevious">
        <a class="btn btn-primary btnPrevious">Anterior</a>
    </div>
    <div class="col-6 col-sm-auto" id="btnNext">
        <a class="btn btn-primary btnNext">Siguiente</a>
    </div>
</div>
    <!--Incluimos el modal para mostrar mensaje de aviso -->

    @include('modales.avisoActividad')

    <!--Incluimos el modal para editar un producto -->

    @include('modales.editarProducto')

@push('js')

    <script type="text/javascript">

        let tipo_actividad;
        let actividad;
        let m = 1; //contador para asignar id al boton que borrara la fila
        let contador = 0; //Contador para llevar el registro de la cantidad de actividades principales agregadas.

        $("#add_actividad").on("click", function(e) {

            tipo_actividad = $("#tipo_actividad").val();
            actividad = $("#actividad").val();

            if(tipo_actividad == 'Primaria'){

                contador++;
            }

            if(tipo_actividad != 'Primaria' || contador <= 1){

                $("#body_table_actividad").append(
                    '<tr id="row_actividad' + m +'">'+
                        '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="tipo_actividad' + m +'" name="tipos_actividades[]" readonly value="' + tipo_actividad +'"></td>'+
                        '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="actividad' + m +'" name="actividades[]" readonly value="' + actividad +'"></td>'+
                        '<td><button type="button" name="remove" id="' + m +'" class="btn btn-danger btn-sm btn_remove_actividad" title="quitar actividad"><i class="fas fa-trash"></i></button></td>'+
                    '</tr>'
                );

                m++;

            }else{

                //Desplegamos el modal
                $('#aviso_actividad').modal('show');

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


    $("#body_table_producto").append(
        '<tr id="row_producto' + n +'">'+
            '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="producto_elaborado' + n +'" name="productos[]" readonly value="' + producto_elaborado +'"></td>'+
            '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="unidad_producida' + n +'" name="unidades[]" readonly value="' + unidad_producida +'"></td>'+
            '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="rnpa' + n +'" name="rnpas[]" readonly value="' + rnpa +'"></td>'+
            '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="produccion_total' + n +'" name="producciones[]" readonly value="' + produccion_total +'"></td>'+
            '<td><button type="button" name="edit" id="'+ n +'" class="btn btn-warning btn-sm btn_edit_producto" title="editar producto"><i class="fas fa-edit"></i></button> <button type="button" name="remove" id="' + n +'" class="btn btn-danger btn-sm btn_remove_producto" title="quitar producto"><i class="fas fa-trash"></i></button></td>'+
        '</tr>'
    );

    n++;

    //Limpiamos cada campo luego de presionar el botón Agregar vehículo

    document.getElementById("producto_elaborado").value = "";
    document.getElementById("unidad_producida").value = "";
    document.getElementById("rnpa").value = "";
    document.getElementById("produccion_total").value = "";

});


$(document).on("click", ".btn_remove_producto", function() {

    //cuando da click al boton quitar, obtenemos el id del boton
    let button_id = $(this).attr("id");

    //borra la fila
    $("#row_producto" + button_id + "").remove();

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
