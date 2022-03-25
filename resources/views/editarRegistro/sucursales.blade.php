<fieldset>

<h2 class="mb-4">Sucursales</h2>
@if ($mode == "edit")

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevaSucursal">
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

    <!--Incluimos el modal para dar de baja un registro -->
    <!-- Falta incluir el modal -->
@include('modales.modalBajaSucursal')
    <br>

    <div class="row navbuttons ">
        <div class="col-6 col-sm-auto" id="btnPrevious">
            <a class="btn btn-outline-secondary btnPrevious">Atrás</a>
        </div>
        <div class="col-6 col-sm-auto" id="btnNext">
            <a class="btn btn-primary btnNext">Siguiente</a>
        </div>
    </div>

    <!--Incluimos el modal para editar los campos -->

    {{--@include('modales.editarSucursal')--}}

</fieldset>


@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(function () {

    console.log({{$id}});

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
                            cellData += row.telefonos[index].cod_area_tel+'-';
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
        $('#nombre_sucursal').val(response [0].nombre_sucursal);
    }
    
    //Desplegamos el modal
    //$('#nuevaSede').modal('show');
    //$('#baja_sede').val(id_registro);
    }
</script>

@endpush
