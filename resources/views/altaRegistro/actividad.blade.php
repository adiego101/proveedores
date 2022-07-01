<fieldset>
<div class="row">
        <h1>Actividad</h1>
</div>

<br/>
    
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
            <select class="js-example-basic-single" aria-describedby="basic-addon1" id="actividad" name="actividad">
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
            <tbody id="body_table_actividad">
                @if(old('tipos_actividades') && old('actividades'))
                    @foreach(old('tipos_actividades') as $actividad)
                        <tr id="row_actividad{{$loop->iteration}}">
                            <td>{{$actividad}}</td>
                            @php
                                $old_actividad=old('actividades')[$loop->index]
                            @endphp
                            @foreach($actividades as $actividad)
                                @if($actividad->desc_actividad == $old_actividad)
                                    <td>{{$actividad->cod_actividad}} - {{$actividad->desc_actividad}}</td>
                                @endif
                            @endforeach
                            <td>
                                <input type="hidden" class="form-control" aria-describedby="basic-addon1" id="tipo_actividad{{$loop->iteration}}" name="tipos_actividades[]" readonly value="{{$actividad}}">
                                <input type="hidden" class="form-control" aria-describedby="basic-addon1" id="actividad{{$loop->iteration}}" name="actividades[]" readonly value="{{old('actividades')[$loop->index]}}">
                                <button type="button" name="remove" id="{{$loop->iteration}}" class="btn btn-danger btn-sm btn_remove_actividad" title="quitar actividad"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <br />

   
    <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

    <!--Incluimos el modal para validar una actividad -->

    @include('modales.validarActividad')


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

@endpush

</fieldset>
