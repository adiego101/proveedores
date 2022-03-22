
<fieldset>

<div class="row">
        <h1>Patente y Seguro</h1>
</div>

<br/>

<!-- <input @if ( $mode == "show") onclick="return false" @endif    type="checkbox" id="vehiculos_afectados" name="vehiculos_afectados"
value="0">
<label for="vehiculos_afectados">Posee vehículos afectados a la actividad económica que desarrolla</label><br>
<br> -->

<h1>Vehículos:</h1><br>

@if ($mode == "edit")

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevaPatente">
    Agregar Nueva Patente
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

<!-- <input @if ( $mode == "show") onclick="return false" @endif    type="checkbox" id="seguros_sta_cruz"  name="seguros_sta_cruz"
value="0">
<label for="seguros_sta_cruz">Posee seguros contratados con promotores residentes en nuestra provincia</label><br>
<br> -->

<h1>Seguros:</h1><br>

@if ($mode == "edit")

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoSeguro">
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

<!-- <input @if ( $mode == "show") onclick="return false" @endif    type="checkbox" id="servicio_personal_especializado" name="servicio_personal_especializado"
value="0">
<label for="servicio_personal_especializado">Utiliza como sede de la actividad económica que desarrolla algún inmueble que tribute impuesto inmobiliario en localidades de la Provincia de Santa Cruz</label><br>
<br> -->

<h1>Sedes:</h1><br>

@if ($mode == "edit")


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevaSede">
    Agregar Nueva Sede
  </button><br>
<hr>
@endif

    <div>

        <table style="width:100%" class="yajra-sedes table table-hover  table-striped table-condensed">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(function () {

    console.log({{$id}});

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

    //Funciones a implementar

    function bajaPatente(id_registro) {

//Desplegamos el modal
$('#modal_baja_patente').modal('show');
$('#baja_patente').val(id_registro);
}
</script>

<script type="text/javascript">
    $(function () {

      console.log({{$id}});

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

      //Funciones a implementar

      function bajaSeguro(id_registro) {

  //Desplegamos el modal
  $('#modal_baja_seguro').modal('show');
  $('#baja_seguro').val(id_registro);
  }
  </script>


<script type="text/javascript">
    $(function () {

      console.log({{$id}});

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
              {data: 'Domicilio', name: 'Domicilio'},
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


    function editarSede(id_registro) {

        $ .ajax ({
              url: "{{ url('sedesBD/'.$id) }}",
              success: function (response) {

                let domicilio = response;
               console.log(domicilio);
               abrirModalEditar(response);
              }
           });

        function abrirModalEditar(response){
            //var domicilio = response [0].Domicilio;
            var longitud = response.length;
            //for (var i = 0; i <longitud; i ++) {
            
            //$('#Domicilio').val(response [i].Domicilio);
            //}

            $('#nuevaSede').modal('show');
            $('#Domicilio').val(response [0].Domicilio);
        }
           
        //Desplegamos el modal
        //$('#nuevaSede').modal('show');
        //$('#baja_sede').val(id_registro);
    }
  </script>

@endpush
