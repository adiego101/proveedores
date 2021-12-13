<fieldset>
<div class="row">
        <h1>Actividad</h1>
</div>

<br/>
    <label for="facturacion_anual_alcanzada">Facturación anual alcanzada:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese el monto de la facturación anual alcanzada" aria-describedby="basic-addon1" id="facturacion_anual_alcanzada"
    name="facturacion_anual_alcanzada"><br>

    <div class="row">
        <div class="col-sm">
            <!--En este caso, se deben recuperar los tipos de actividad de la BD -->
            <label for="tipo_actividad">Tipo de Actividad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="tipo_actividad" name="tipo_actividad">
                    @foreach($tipos_actividades as $tipo_actividad)
                    <option value="{{$tipo_actividad->desc_tipo_actividad}}">{{$tipo_actividad->desc_tipo_actividad}}</option>
                    @endforeach
                </select>
            <br />

            <!--En este caso, se deben recuperar las actividades de la BD -->
            <label for="actividad">Actividad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="actividad" name="actividad">
                    @foreach($actividades as $actividad)
                    <option value="{{$actividad->desc_actividad}}">{{$actividad->desc_actividad}}</option>
                    @endforeach
                </select>
                <br />
        </div>

        <div class="col-sm">

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



    <label for="rne">Registro Nacional de Establecimientos (RNE) N°:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese el número de RNE" aria-describedby="basic-addon1" id="rne" name="rne"><br>

    <label for="codigo_de_actividades">Codigo de actividades</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="codigo_de_actividades"
        name="codigo_de_actividades"><br>

    <label for="nomina_productos">Nomina de Principales Productos Elaborados:</label><br>
    <input type="text" class="form-control" aria-describedby="basic-addon1" id="nomina_productos"
        name="nomina_productos"><br>


    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />


    <!--Incluimos el modal para editar los campos de una actividad -->
    @include('modales.editarActividad')
@push('js')

    <script type="text/javascript">

        let tipo_actividad;
        let actividad;
        let m = 1; //contador para asignar id al boton que borrara la fila
        $("#add_actividad").on("click", function(e) {

            tipo_actividad = $("#tipo_actividad").val();
            actividad = $("#actividad").val();

            $("#body_table_actividad").append(
                '<tr id="row_actividad' + m +'">'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="tipo_actividad' + m +'" name="tipos_actividades[]" readonly value="' + tipo_actividad +'"></td>'+
                    '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="actividad' + m +'" name="actividades[]" readonly value="' + actividad +'"></td>'+
                    '<td><button type="button" name="edit" id="'+ m +'" class="btn btn-warning btn-sm btn_edit_actividad" title="editar actividad" data-toggle="modal" data-target="#modal_actividad"><i class="fas fa-edit"></i></button> <button type="button" name="remove" id="' + m +'" class="btn btn-danger btn-sm btn_remove_actividad" title="quitar actividad"><i class="fas fa-trash"></i></button></td>'+
                '</tr>'
            );


            m++;
        });

            $(document).on("click", ".btn_remove_actividad", function() {

                //cuando da click al boton quitar, obtenemos el id del boton
                let button_id = $(this).attr("id");

                //borra la fila
                $("#row_actividad" + button_id + "").remove();
            });












    </script>
@endpush


</fieldset>
