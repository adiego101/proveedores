<fieldset>
    <h1>Pagos</h1>
    <br>
    <label for="tipo_proveedor">Tipo de Proovedor:</label><br>
    {{-- CAMBIO FORMA DE UTILIZAR CHECKBOX
        <div class="row">
            <div class="col-sm">
                <input type="checkbox" id="prov_estado"  value="0"   name="prov_estado">
                <label for="prov_estado">Proveedor del Estado</label><br>
                <input type="checkbox" id="prov_minero"  value="0"   name="prov_minero">
                <label for="prov_minero">Proveedor Minero</label><br>

            </div>
            <div class="col-sm">
                <input type="checkbox" id="prov_petrolero"  value="0"   name="prov_petrolero">
                <label for="prov_petrolero">Proveedor Petrolero</label><br>
                <input type="checkbox" id="prov_provincial"  value="0"   name="prov_provincial">
                <label for="prov_provincial">Proveedor Provincial</label><br>
            </div>
        </div> --}}
    <div class="form-check">
        <div class="row">
            <div class="col col-md-6">
                <input class="form-check-input tipo_proveedor" type="checkbox" name="tipo_proveedor[]"
                    value="PROVEEDOR DEL ESTADO">PROVEEDOR DEL ESTADO<br>
                <input class="form-check-input tipo_proveedor" type="checkbox" name="tipo_proveedor[]"
                    value="PROVEEDOR MINERO">PROVEEDOR MINERO<br>
                <input class="form-check-input tipo_proveedor" type="checkbox" name="tipo_proveedor[]"
                    value="PROVEEDOR PETROLERO">PROVEEDOR PETROLERO<br>
                <input class="form-check-input tipo_proveedor" type="checkbox" name="tipo_proveedor[]"
                    value="PRODUCTOR PROVINCIAL">PRODUCTOR PROVINCIAL<br>
            </div>
        </div>
    </div>
    <br>
    <!-- CAMBIO Registro de Pagos de inscripción y renovación: POR UN TITULO EN LUGAR DE UN CAMPO DE TEXTO
        <label for="registro-pagos-inscripccion">Registro de Pagos de inscripción y renovación:</label><br>
        <input type="text" class="form-control" aria-describedby="basic-addon1" id="registro-pagos-inscripccion"
            name="registro-pagos-inscripccion" ><br>
        <hr>
        -->
    <h5>Registro de Pagos de inscripción y renovación:</h5><br>

    <label for="fecha-pago">Fecha:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese la fecha en la que se realizó el pago"
        aria-describedby="basic-addon1" id="fecha-pago"><br>

    <label for="importe-pago">Importe:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese el importe pagado" aria-describedby="basic-addon1"
        id="importe-pago"><br>

    <label for="observaciones-pago">Observaciones:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese las observaciones del pago"
        aria-describedby="basic-addon1" id="observaciones-pago"><br>

    <input type="button" value="Agregar" class="btn btn-outline-primary" id="agregar-pago">
    <div class="table table-bordered">
        <table id="tabla-pagos">
            <thead align="center">
                <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Importe</th>
                    <th scope="col">Observaciones</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody id="body_pagos_table"></tbody>
        </table>
    </div>

    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />

    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

</fieldset>
@include('modales.editarPago')
@section('js')

    <script type="text/javascript">
        let fecha;
        let importe;
        let obsevarciones;
        $("#agregar-pago").on("click", function(e) {
            fecha = $('#fecha-pago').val();
            $('#fecha-pago').val() = '';
            importe = $('#importe-pago').val();
            $('#importe-pago').val() = '';
            obsevarciones = $('#observaciones').val();
            $('#observaciones').val() = '';

            $("#body_pagos_table").append(
                '<tr id="row' + i + '">' +
                '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="fecha' + i +
                '" name="fechas-pagos[]" readonly value="' + fecha + '"></td>' +
                '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="importe' + i +
                '" name="importes-pagos[]" readonly value="' + importe + '"></td>' +
                '<td><input type="text" class="form-control" aria-describedby="basic-addon1" id="observaciones' +
                i + '" name="observaciones-pagos[]" readonly value="' + observaciones + '"></td>' +
                '<td><button type="button" name="edit" id="' + i +
                '" class="btn btn-warning btn-sm btn_edit" title="editar pago"><i class="fas fa-edit"></i></button>' +
                '<button type="button" name="remove" id="' + i +
                '" class="btn btn-danger btn-sm btn_remove" title="quitar pago"><i class="fas fa-trash"></i></button>' +
                '</td>' +
                '</tr>'
            );
        );}
            $(document).on("click", ".btn_remove", function() {

                //cuando da click al boton quitar, obtenemos el id del boton
                let button_id = $(this).attr("id");

                //borra la fila
                $("#row" + button_id + "").remove();
            });



            //Cargamos los inputs del modal con los datos de la fila de la tabla

            $(document).on("click", ".btn_edit", function() {
                //cuando da click al boton editar, obtenemos el id del boton
                let button_id = $(this).attr("id");
                //Recuperamos los valores de los campos pertenecientes a una fila
                let modal_fecha = $("#fecha" + button_id).val();
                let modal_importe = $("#importe" + button_id).val();
                let modal_observaciones = $("#observaciones" + button_id).val();

                //Desplegamos el modal
                $('#editarPagoModal').modal('show');

                //Enviamos los valores recuperados anteriormente a los inputs del modal
                $('#modal_fecha').val(modal_fecha);
                $('#modal_importe').val(modal_importe);
                $('#modal_observaciones').val(modal_observaciones);
            });
        );
    </script>
@endsection
