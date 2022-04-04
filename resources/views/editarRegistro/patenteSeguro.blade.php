<fieldset>

<div class="row">
        <h1>Patente y Seguro</h1>
</div>

<br/>

<h1>Vehículos:</h1><br>

@if ($mode == "edit")

<button type="button" class="btn btn-success" data-toggle="modal" data-target="#nuevoVehiculo">
    Agregar Nuevo Vehículo
  </button><br>
<hr>
    @endif

<div>

    <table style="width:100%" class="yajra-vehiculos table table-hover  table-striped table-condensed">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Dominio</th>
                <th>Inscripto en</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

@include('modales.modalBajaPatente')

    <br>

    <hr>

<h1>Seguros:</h1><br>

@if ($mode == "edit")

<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#nuevoSeguro">
    Agregar Nuevo Seguro
  </button><br>
<hr>
@endif
<div>

    <table style="width:100%" class="yajra-seguros table table-hover  table-striped table-condensed">
        <thead>
            <tr>
                <th>Póliza</th>
                <th>Agencia</th>
                <th>Asegurado</th>
                <th>Vigencia hasta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@include('modales.modalBajaSeguro')

    <br />

    <hr>

<h1>Sedes:</h1><br>

@if ($mode == "edit")


<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#nuevaSede">
    Agregar Nueva Sede
  </button><br>
<hr>
@endif

    <div>
        <table style="width:100%" id="table" class="yajra-sedes table table-hover  table-striped table-condensed">
            <thead>
                <tr>
                    <th>Domicilio</th>
                    <th>Localidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    @include('modales.modalBajaSede')

    <br />

    <div class="row navbuttons ">
    <div class="col-6 col-sm-auto" id="btnPrevious">
        <a class="btn btn-outline-secondary btnPrevious">Atrás</a>
    </div>
    <div class="col-6 col-sm-auto" id="btnNext">
        <a class="btn btn-primary btnNext">Siguiente</a>
    </div>
</div>

</fieldset>

@push('js')

<!-- Scripts VEHICULOS -->

<script type="text/javascript">
  $(function () {

    var table = $('.yajra-vehiculos').DataTable({
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
        ajax: "{{ url('patentes/'.$id.'/'.$mode) }}",
        columns: [
            {data: 'marca', name: 'marca'},
            {data: 'modelo', name: 'modelo'},
            {data: 'dominio', name: 'dominio'},
            {data: 'inscripto_en', name: 'inscripto_en'},

            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });

  });


    function bajaPatente(id_registro) {

        //Desplegamos el modal
        $('#modal_baja_patente').modal('show');
        $('#baja_patente').val(id_registro);
    }


    //Enviamos el id del registro que queremos modificar (id de la tabla)
    function editarPatente(id_registro) {

        $.ajax ({
        url: "{{ url('patentesBD/') }}/"+id_registro,
        success: function (response) {

            abrirModalEditarPatente(response);
        }
        });


        function abrirModalEditarPatente(response){

            //Desplegamos el modal
            $('#editarVehiculo').modal('show');
            //Enviamos los valores a cada campo
            $('#marcas').val(response [0].marca);
            $('#dominios').val(response [0].dominio);
            $('#modelos').val(response [0].modelo);
            $('#inscriptos_en').val(response [0].inscripto_en);
            $('#id_proveedor_patente').val(response [0].id_proveedor_patente);

        }

    }

</script>



<!-- Scripts SEGUROS -->

<script type="text/javascript">

    $(function () {

      var table = $('.yajra-seguros').DataTable({
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
          ajax: "{{ url('seguros/'.$id.'/'.$mode) }}",
          columns: [
              {data: 'poliza', name: 'poliza'},
              {data: 'agencia', name: 'agencia'},
              {data: 'asegurado', name: 'asegurado'},
              {data: 'vigencia_hasta',

                render: function(data){

                    let fecha_sin_hora_seguros = data.split(' ')[0];
                    let fecha_local_seguros = fecha_sin_hora_seguros.split('-').reverse().join('/');

                    return fecha_local_seguros;
                }

              },

              {
                  data: 'action',
                  name: 'action',
                  orderable: true,
                  searchable: true
              },
          ]
      });

    });



    function bajaSeguro(id_registro) {

        //Desplegamos el modal
        $('#modal_baja_seguro').modal('show');
        $('#baja_seguro').val(id_registro);
    }


    //Enviamos el id del registro que queremos modificar (id de la tabla)
    function editarSeguro(id_registro) {

        $.ajax ({
        url: "{{ url('segurosBD/') }}/"+id_registro,
        success: function (response) {

            abrirModalEditarSeguro(response);
        }
        });


        function abrirModalEditarSeguro(response){

            //Desplegamos el modal
            $('#editarSeguro').modal('show');
            //Enviamos los valores a cada campo
            $('#polizas').val(response [0].poliza);
            $('#asegurados').val(response [0].asegurado);
            $('#agencias').val(response [0].agencia);
            let vigencia_hasta = response [0].vigencia_hasta;
            vigencia_hasta = vigencia_hasta.split(" ");
            vigencia = vigencia_hasta[0];
            $('#vigencias_hasta').val(vigencia);
            $('#id_proveedor_seguro').val(response [0].id_proveedor_seguro);

        }

    }

  </script>



<!-- Scripts SEDES -->

<script type="text/javascript">

    $(function () {

      var table = $('.yajra-sedes').DataTable({
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
          ajax: "{{ url('sedes/'.$id.'/'.$mode) }}",
          columns: [
              {data: 'domicilio', name: 'domicilio'},
              {data: 'nombre_localidad', name: 'nombre_localidad'},
              {
                  data: 'action',
                  name: 'action',
                  orderable: true,
                  searchable: true
              },
          ]
      });

    });



    function bajaSede(id_registro) {

        //Desplegamos el modal
        $('#modal_baja_sede').modal('show');
        $('#baja_sede').val(id_registro);
    }


    //Enviamos el id del registro que queremos modificar (id de la tabla)
    function editarSede(id_registro) {

        $ .ajax ({
              url: "{{ url('sedesBD/') }}/"+id_registro,
              success: function (response) {

                    abrirModalEditarSede(response);
              }
           });


        function abrirModalEditarSede(response){

            //Desplegamos el modal
            $('#editarSede').modal('show');
            //Enviamos los valores a cada campo
            $('#Domicilios').val(response [0].domicilio);
            $('#provincia_sedes').val(response [0].nombre_provincia);
            $('#Localidades').val(response [0].id_localidad);
            $('#id_proveedor_sede').val(response [0].id_proveedor_sede);
            //console.log(response);

        }

    }

  </script>

@endpush
