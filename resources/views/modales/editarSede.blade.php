<!-- Modal -->
<div id="modal_sede" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Contenido del Modal-->
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Editar Sede</h1>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <label for="modal_domicilio_sede">Domicilio:</label><br />
                    <input type="text" class="form-control" placeholder="Ingrese el domicilio" aria-describedby="basic-addon1" id="modal_domicilio_sede" name="modal_domicilio_sede" maxlength="50"/><br />

                    <label for="modal_provincia_sede">Provincia:</label><br>
                    <select class="form-control" aria-describedby="basic-addon1" id="modal_provincia_sede" name="modal_provincia_sede">
                        <option value=" ">Seleccione una provincia</option>
                        @forelse($provincias as $provincia)
                            <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                        @empty
                            <option value=" "></option>
                        @endforelse
                    </select>
                    <br>
                            
                    <label for="modal_localidad_sede">Localidad:</label><br>
                    <select class="form-control" aria-describedby="basic-addon1" id="modal_localidad_sede" name="modal_localidad_sede">
                        <option value=" ">Seleccione una localidad</option>
                        @forelse($localidades as $localidad)
                            <option value="{{$localidad->id_localidad}}">{{$localidad->nombre_localidad}}</option>
                        @empty
                            <option value=" "></option>
                        @endforelse
                    </select>
                    <br>
                 
                    <div class="modal-footer">
                        <input id="numero_fila_sede" name="numero_fila_sede" type="hidden">
                        <button type="button" name="edit" class="btn btn-success btn_edit_modal">Editar</button>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('js')

<script type="text/javascript">

//Modificamos los valores actuales, por los nuevos valores ingresados en el modal

$(document).on("click", ".btn_edit_modal", function(event) {

    //Obtenemos el numero de la fila que queremos modificar
    var id_fila = $("#numero_fila_sede").val();

    //Recuperamos los valores de los campos del modal
    var modal_domicilio = $("#modal_domicilio_sede").val();
    var modal_localidad_id = $("#modal_localidad_sede").val();
    var modal_localidad_valor = $("#modal_localidad_sede").find('option:selected').text();
    var modal_provincia = $("#modal_provincia_sede").val();

    //Obtenemos los campos obligatorios para aplicarles estilos css
    let modal_domicilio_css = document.getElementById("modal_domicilio_sede");
    let modal_localidad_css = document.getElementById("modal_localidad_sede");
    let modal_provincia_css = document.getElementById("modal_provincia_sede");

    //Si los campos obligatorios NO estan vacios, permite enviar los nuevos valores a la tabla
    if(modal_domicilio.length != 0 && modal_localidad_id != " " && modal_provincia != " "){

        //Ocultamos el modal
        $('#modal_sede').modal('hide');

        //Enviamos los valores recuperados anteriormente del modal, a los inputs de la tabla
        $('#domicilio_sede'+id_fila).val(modal_domicilio);
        $('#localidad_sede'+id_fila).val(modal_localidad_id);
        $('#provincia_sede'+id_fila).val(modal_provincia);

        //Enviamos los valores recuperados anteriormente del modal, a los textos visibles de la tabla
        $('#domicilio_sede_text'+id_fila).text(modal_domicilio);
        $('#localidad_sede_text'+id_fila).text(modal_localidad_valor);
        $('#provincia_sede_text'+id_fila).text(modal_provincia);

        modal_domicilio_css.style.border = '1px solid #DFDFDF';
        modal_localidad_css.style.border = '1px solid #DFDFDF';
        modal_provincia_css.style.border = '1px solid #DFDFDF';

    } else {

            //Si alguno de los campos obligatorios esta vacio, detenemos el envio de los datos.
            event.preventDefault();

            modal_domicilio_css.style.border = '2px dashed red';
            modal_localidad_css.style.border = '2px dashed red';
            modal_provincia_css.style.border = '2px dashed red';

    }

});

</script>

<script type="text/javascript">
	$(document).ready(function(){

		$('#modal_provincia_sede').change(function(){
			recargarListaSedeModal();
		});
	})

</script>

<script type="text/javascript">
	function recargarListaSedeModal(){
		$.ajax({
			type:"GET",
			url:"localidades/"+$('#modal_provincia_sede').val(),
			success:function(r){
				$('#modal_localidad_sede').html(r);
			}
		});
	}
</script>

@endpush
