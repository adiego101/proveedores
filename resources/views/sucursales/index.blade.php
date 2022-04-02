<h2 class="mb-4">Sucursales</h2>
@if ($mode == "edit")

<!-- Button trigger modal -->
<button type="button" id="btnNuevaSucursal" class="btn btn-success" data-toggle="modal" data-target="#nuevaSucursal">
    Agregar Nueva Sucursal
  </button><br>
<hr>
@endif

<div>

    <table style="width:100%" class="yajra-sucursal yajra-datatable table table-hover  table-striped table-condensed">
        <thead>
            <tr>
                <th>Nombre sucursal</th>
                <th>Correo electrónico</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
              <!--  <th>Username</th>
                <th>Phone</th>
                <th>DOB</th> -->
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!--Incluimos el modal para crear sucursal -->


<br>



@push('js')



<script type="text/javascript">

  $("#document").ready(function () {


    var table = $('.yajra-datatable').DataTable({
    language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
        processing: true,
        serverSide: true,
        ajax: "{{ url('sucursales/'.$id.'/'.$mode) }}",
        columns: [
            {   data: 'nombre_sucursal',
                name: 'nombre_sucursal'
            },
            {   data: 'emails',
                name: 'emails',
                render: {
                    _: '[/ ].email'
                },
                defaultContent: "",
                searchable: false
            },
            {   data: null,
                name: 'telefonos',
                render: function (data, type, row) {
                    let cellData = '';
                    for (let index = 0; index < row.telefonos.length; index++) {
                        if(row.telefonos[index].tipo_medio!=null)
                            cellData += row.telefonos[index].tipo_medio+':';
                        if(row.telefonos[index].cod_area_tel!=null)
                            cellData += row.telefonos[index].cod_area_tel+' ';
                        if(row.telefonos[index].nro_tel!=null)
                            if(index==row.telefonos.length-1)
                                cellData += row.telefonos[index].nro_tel;
                            else
                                cellData += row.telefonos[index].nro_tel+'/';
                    }
                    return cellData;
                },
                defaultContent: "",
                searchable: false
            },
            //{data: 'cuit', name: 'cuit'},
            //{data: 'en_la_provincia_de', name: 'en_la_provincia_de'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
    $(document).on('click', '.edit_sucursal', function() {
        var id_proveedor = $(this).data('id_proveedor');
        var id_sucursal = $(this).data('id_sucursal');
        $.ajax({
            url:"{{ url('editarSucursales/') }}/" + id_sucursal,
            success:function(view) {

                    /*console.log('valor del input 1-->'+$('#modal_calle_sucursal').val());
                    console.log('valor con get element id = '+document.getElementById('modal_calle_sucursal').value);
                    $('#modal_calle_sucursal').val(sucursal.calle);
                    $("#modal_calle_sucursal").trigger("change");
                    console.log('valor del input 2-->'+$('#modal_calle_sucursal').val());
                    console.log('valor con get element id = '+document.getElementById('modal_calle_sucursal').value);
                    $('#modal_numero_sucursal').val(sucursal.numero);
                    $('#modal_editarSucursal').modal('toggle'); */

                      $("#respuesta").html(view);
                      $("#editar_sucursal").val(id_sucursal) ;

                      $('#editarSucursal').modal('show');
                }
        });
    });
    $(document).on('click', '.view_sucursal', function() {
        var id_proveedor = $(this).data('id_proveedor');
        var id_sucursal = $(this).data('id_sucursal');
        console.log('id_proveedor='+id_proveedor+' id_sucursal='+id_sucursal);
        $.ajax({
            url:"{{ url('verSucursales/') }}/" + id_sucursal,
            success:function(view) {

                    /*console.log('valor del input 1-->'+$('#modal_calle_sucursal').val());
                    console.log('valor con get element id = '+document.getElementById('modal_calle_sucursal').value);
                    $('#modal_calle_sucursal').val(sucursal.calle);
                    $("#modal_calle_sucursal").trigger("change");
                    console.log('valor del input 2-->'+$('#modal_calle_sucursal').val());
                    console.log('valor con get element id = '+document.getElementById('modal_calle_sucursal').value);
                    $('#modal_numero_sucursal').val(sucursal.numero);
                    $('#modal_editarSucursal').modal('toggle'); */

                      $("#respuesta").html(view);
                      $("#editar_sucursal").val(id_sucursal) ;

                      $('#editarSucursal').modal('show');
                }
        });
    });
  });

    //Funciones a implementar

    function verRegistro() {

        return  alert("Retornar vista para visualizar un registro!");
    }


    function bajaSucursal(id_sucursal) {

         //Desplegamos el modal
         $('#modalBajaSucursal').modal('show');
         $('#baja').val(id_sucursal);
    }

    function editarSucursal(id_sucursal) {

        $ .ajax ({
            url: "{{ url('sucursalesBD/'.$id) }}",
            success: function (response) {
                abrirModalEditar(response);
            }
        });

    

    function abrirModalEditar(response){
        //var domicilio = response [0].Domicilio;
        var longitud = response.length;
        //for (var i = 0; i <longitud; i ++) {

        //$('#Domicilio').val(response [i].Domicilio);
        //}

        $('#nuevaSucursal').modal('show');
        //$('#nombre_sucursal').val(response [0].nombre_sucursal);
    }

    //Desplegamos el modal
    //$('#nuevaSede').modal('show');
    //$('#baja_sede').val(id_registro);
    }
</script>

<script type="text/javascript">

	$(document).ready(function(){

        $(document).on('change', '#provincia.edit', function() {
			$.ajax({
                type:"GET",
                url:"{{url('localidades/')}}/"+$(this).children("option:selected").val(),
                success:function(r){
                    $('#id_localidad.edit').html(r);
                }
		    });
		});

        $(document).on('change', '#provincia.create', function() {
			$.ajax({
                type:"GET",
                url:"{{url('localidades/')}}/"+$(this).children("option:selected").val(),
                success:function(r){
                    $('#id_localidad.create').html(r);
                }
		    });
		});
	})
    window.onload = function(){

        {{isset($sucursal->id_localidad) ? 'recargarListaSucursal2();' : ''}}

        };

</script>


<script type="text/javascript">

    function recargarListaSucursal2(){
        $.ajax({
            type:"GET",
            url:"{{url('localidadSelect/')}}/{{isset($sucursal->id_localidad) ? $sucursal->id_localidad : ''}}",
            success:function(r){
                $('#id_localidad').html(r);
            }
        });
    }

</script>

<script type="text/javascript">

    function valideKey(evt){

        // El código es la representación decimal ASCII de la clave presionada.
        var code = (evt.which) ? evt.which : evt.keyCode;

        if(code==8) { // espacio.
          return true;
        } else if(code>=48 && code<=57) { // es un numero.
          return true;
        } else{ // otras teclas
        //console.log("no es un numero");
          return false;
        }
    }

</script>

<script>


    //Damos de alta una nueva sede en la BD.

    $(document).ready(  function()
        {
            $('#addformSucursal').on('submit', function(e)
            {
                e.preventDefault();
                $("button").prop("disabled", true);


                $.ajax({
                    type: "post",
                    url: "{{url('crearSucursales/'.$id)}}",
                    data: $('#addformSucursal').serialize(),
                    success: function (response) {
                        //console.log(response)
                        $('#nuevaSucursal').modal('hide');
                        $('#addformSucursal :input').val('');
                        $("#pais option:first").attr('selected','selected');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Sucursal Guardada',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })
                            $("button").prop("disabled", false);

                        $('.yajra-sucursal').DataTable().ajax.reload();

                    },
                    error: function(error){
                        //console.log(error)
                        $("button").prop("disabled", false);
                        alert("ERROR!! Sucursal no guardada")
                    }
                });
            }
            );
        }
    );
</script>

@endpush
