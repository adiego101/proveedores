<!-- Modal -->
<div id="modal_sucursal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Contenido del Modal-->
        <div class="modal-content">
            <div class="modal-header">
                <h1>Editar Sucursal</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <label for="modal_nombre_sucursal">Nombre Sucursal:</label><br />
                <input type="text" class="form-control" placeholder="Ingrese el nombre de la sucursal" aria-describedby="basic-addon1" id="modal_nombre_sucursal" /><br />

                <div class="row">
                    <div class="col-sm">
                        <label for="modal_calle_sucursal">Calle:</label><br />
                        <input type="text" class="form-control" placeholder="Calle" aria-describedby="basic-addon1"
                            id="modal_calle_sucursal"/><br />

                        <label for="modal_dpto_sucursal">Departamento:</label><br />
                        <input type="text" class="form-control" placeholder="Departamento" aria-describedby="basic-addon1"
                            id="modal_dpto_sucursal" /><br />

                        <label for="modal_lote_sucursal">Lote:</label><br />
                        <input type="text" class="form-control" placeholder="Lote" aria-describedby="basic-addon1" id="modal_lote_sucursal" name="lotes[]" /><br />

                        <label for="modal_entre_calles_sucursal">Entre Calles:</label><br />
                        <input type="text" class="form-control" placeholder="Entre Calles" aria-describedby="basic-addon1" id="modal_entre_calles_sucursal" /><br />

                        <label for="modal_monoblock_sucursal">Monoblock:</label><br />
                        <input type="text" class="form-control" placeholder="Monoblock" aria-describedby="basic-addon1" id="modal_monoblock_sucursal" name="monoblocks[]" /><br />

                        <!--En este caso, se deben recuperar los paises de la BD -->
                        <label for="modal_pais_sucursal">Pais:</label><br>
                        <select class="form-control" aria-describedby="basic-addon1" id="modal_pais_sucursal" name="modal_pais_sucursal">
                            @forelse($paises as $pais)
                                <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                            @empty
                                <option value=" "></option>
                            @endforelse
                        </select>
                        <br>

                        <!--En este caso, se deben recuperar las localidades de la BD -->
                        <label for="modal_localidad_sucursal">Localidad:</label><br>
                        <select class="form-control" aria-describedby="basic-addon1" id="modal_localidad_sucursal" name="modal_localidad_sucursal">
                        <option value=" ">Seleccione una localidad</option>
                        </select>
                        <br>

                        <label for="modal_email_sucursal">Correo electrónico:</label><br>
                        <input id="modal_email_sucursal" type="email" class="form-control email_sucursal" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1"><br>

                    </div>

                    <div class="col-sm">

                        <label for="modal_numero_sucursal">Numero:</label><br />
                        <input type="number" class="form-control" placeholder="Numero" aria-describedby="basic-addon1" id="modal_numero_sucursal" /><br />

                        <label for="modal_puerta_sucursal">Puerta:</label><br />
                        <input type="number" class="form-control" placeholder="Puerta" aria-describedby="basic-addon1" id="modal_puerta_sucursal" name="puertas[]" /><br />

                        <label for="modal_manzana_sucursal">Manzana:</label><br />
                        <input type="number" class="form-control" placeholder="Manzana" aria-describedby="basic-addon1" id="modal_manzana_sucursal" name="manzanas[]" /><br />

                        <label for="modal_oficina_sucursal">Oficina:</label><br />
                        <input type="text" class="form-control" placeholder="Oficina" aria-describedby="basic-addon1" id="modal_oficina_sucursal" name="oficinas[]" /><br />

                        <label for="modal_barrio_sucursal">Barrio:</label><br />
                        <input type="text" class="form-control" placeholder="Barrio" aria-describedby="basic-addon1" id="modal_barrio_sucursal" /><br />

                        <!--En este caso, se deben recuperar las provincias de la BD -->
                        <label for="modal_provincia_sucursal">Provincia:</label><br>
                        <select class="form-control" aria-describedby="basic-addon1" id="modal_provincia_sucursal" name="modal_provincia_sucursal">
                        <option value=" ">Seleccione una provincia</option>
                            @forelse($provincias as $provincia)
                                <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                            @empty
                                <option value=" "></option>
                            @endforelse
                        </select>
                        <br>

                        <label for="modal_codigo_postal_sucursal">Código Postal:</label><br>
                        <input type="text" class="form-control" aria-describedby="basic-addon1" id="modal_codigo_postal_sucursal" name="modal_codigo_postal_sucursal" placeholder="Ingrese el código postal"><br>

                        <label for="modal_telefono_sucursal">Teléfono:</label><br>
                        <input type="number" id="modal_telefono_sucursal" class="form-control telefono_sucursal" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" >

                    </div>

                </div>

                <div class="modal-footer">
                    <input id="numero_fila_sucursal" name="numero_fila_sucursal" type="hidden">
                    <button type="button" name="edit" class="btn btn-success btn_edit_modal_sucursal">Editar</button>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')

<script type="text/javascript">

//Modificamos los valores actuales, por los nuevos valores ingresados en el modal

$(document).on("click", ".btn_edit_modal_sucursal", function() {

            //Obtenemos el numero de la fila que queremos modificar
            var id_filasu = $("#numero_fila_sucursal").val();

            //Recuperamos los valores de los campos del modal
            var modal_calle = $("#modal_calle_sucursal").val();
            var modal_numero = $("#modal_numero_sucursal").val();
            var modal_entre_calles = $("#modal_entre_calles_sucursal").val();
            var modal_barrio = $("#modal_barrio_sucursal").val();
            var modal_departamento = $("#modal_dpto_sucursal").val();
            var modal_telefono = $("#modal_telefono_sucursal").val();
            var modal_email = $("#modal_email_sucursal").val();

            //Ocultamos el modal
            $('#modal_sucursal').modal('hide');

            //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla
            $('#calle_sucursal'+id_filasu).val(modal_calle);
            $('#numero_sucursal'+id_filasu).val(modal_numero);
            $('#entre_calles_sucursal'+id_filasu).val(modal_entre_calles);
            $('#barrio_sucursal'+id_filasu).val(modal_barrio);
            $('#dpto_sucursal'+id_filasu).val(modal_departamento);
            $('#telefono_sucursal'+id_filasu).val(modal_telefono);
            $('#email_sucursal'+id_filasu).val(modal_email);

        });
</script>

<script type="text/javascript">
	$(document).ready(function(){

		$('#modal_provincia_sucursal').change(function(){
			recargarListaSucursalModal();
		});
	})
</script>

<script type="text/javascript">
	function recargarListaSucursalModal(){
		$.ajax({
			type:"GET",
			url:"localidades/"+$('#modal_provincia_sucursal').val(),
			success:function(r){
				$('#modal_localidad_sucursal').html(r);
			}
		});
	}
</script>

@endpush
