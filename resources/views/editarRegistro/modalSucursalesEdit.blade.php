<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Contenido del Modal-->
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Editar Sucursal</h1>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            <div class="modal-body">
            <div class="row">
    </div>

    <br />
    
<!-- SE DEBEN ELIMINAR LOS ATRIBUTOS NAME DE CADA CAMPO Y SOLO DEJARLOS EN EL APPEND JS, PORQUE SINO AL ENVIAR LOS DATOS A LA BD SE ALMACENA SIEMPRE UN VALOR NULO AL PRINCIPIO. -->

    <div class="row">
        <div class="col-sm">
            <label for="calle">Calle:</label><br />
            <input type="text" class="form-control" placeholder="Calle" aria-describedby="basic-addon1"
                id="modal_calle" /><br />

            <label for="entre_calles">Entre Calle:</label><br />
            <input type="text" class="form-control" placeholder="Entre Calles" aria-describedby="basic-addon1"
                id="modal_entre_calles" /><br />

            <label for="dpto">Departamento:</label><br />
            <input type="text" class="form-control" placeholder="Departamento" aria-describedby="basic-addon1"
                id="modal_dpto" /><br />

            {{-- <label for="lote">Lote:</label><br />
            <input type="text" class="form-control" placeholder="Lote" aria-describedby="basic-addon1" id="lote" name="lotes[]" /><br /> --}}

            {{-- <label for="monoblock">Monoblock:</label><br />
            <input type="text" class="form-control" placeholder="Monoblock" aria-describedby="basic-addon1"
                id="monoblock" name="monoblocks[]" /><br />

            <label for="localidad">Localidad:</label><br />
            <input type="text" class="form-control" aria-describedby="basic-addon1" placeholder="Localidad"
                id="localidad" name="Localidades[]" /><br /> --}}
            
            <label for="email">Correo electrónico:</label><br />
            <input type="email" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="modal_email" name="correos_electronicos[]" /><br />
        </div>

        <div class="col-sm">

            <label for="numero">Numero:</label><br />
            <input type="number" class="form-control" placeholder="Numero" aria-describedby="basic-addon1"
                id="modal_numero" /><br />

            {{-- <label for="puerta">Puerta:</label><br />
            <input type="text" class="form-control" placeholder="Puerta" aria-describedby="basic-addon1"
                id="puerta" name="puertas[]" /><br />

            <label for="oficina">Oficina:</label><br />
            <input type="text" class="form-control" placeholder="Oficina" aria-describedby="basic-addon1"
                id="oficina" name="oficinas[]" /><br />

            <label for="manzana">Manzana:</label><br />
            <input type="text" class="form-control" placeholder="Manzana" aria-describedby="basic-addon1"
                id="manzana" name="manzanas[]" /><br /> --}} 
                
            <label for="barrio">Barrio:</label><br />
            <input type="text" class="form-control" placeholder="Barrio" aria-describedby="basic-addon1"
                id="modal_barrio" /><br />

            <label for="nro_tel">Telefono:</label><br />
            <input type="number" class="form-control" aria-describedby="basic-addon1" placeholder="Número de teléfono" id="modal_nro_tel" /><br /><br />

        </div>
    </div>

            </div>
            <div class="modal-footer">
                <input id="numero_fila" name="numero_fila" type="hidden">
                <button type="button" name="edit" class="btn btn-warning btn_edit_modal">Editar</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script type="text/javascript">

    //Modificamos los valores actuales, por los nuevos valores ingresados en el modal

    $(document).on("click", ".btn_edit_modal", function() {
                
                //Obtenemos el numero de la fila que queremos modificar
                var id_fila=$("#numero_fila").val();

                //Recuperamos los valores de los campos del modal
                var modal_calle=$("#modal_calle").val();
                var modal_numero=$("#modal_numero").val();
                var modal_entre_calles=$("#modal_entre_calles").val();
                var modal_barrio=$("#modal_barrio").val();
                var modal_departamento=$("#modal_dpto").val();
                var modal_telefono=$("#modal_nro_tel").val();
                var modal_email=$("#modal_email").val();

                //Ocultamos el modal
                $('#myModal').modal('hide'); 
            
                //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla
                $('#calle'+id_fila).val(modal_calle);
                $('#numero'+id_fila).val(modal_numero);
                $('#entre_calles'+id_fila).val(modal_entre_calles);
                $('#barrio'+id_fila).val(modal_barrio);
                $('#dpto'+id_fila).val(modal_departamento);
                $('#nro_tel'+id_fila).val(modal_telefono);
                $('#email'+id_fila).val(modal_email);
                
            });
            </script>