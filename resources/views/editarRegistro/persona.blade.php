<fieldset>
    @switch($tipo_persona)
        @case ('miembro')
            <h1>Personas Físicas / Sucesiones indivisas / Sociedades de Hecho / S.A.S <sup>*</sup></h1>
            <p><sup>*</sup>Las sociedades detalladas deberán mencionar sus integrantes</p>
        @break
        @case ('direccion_firma')
            <h1>Miembros de los órganos de dirección y administración de firma<sup>*</sup></h1>
            <p><sup>*</sup>Sólo para personas jurídicas</p>
        @break
        @case ('apoderado')
            <h1>Apoderado/s de firma</h1>
        @break
    @endswitch
    @if($mode != 'show')
        @switch($tipo_persona)
            @case('miembro')
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_persona" data-tipo-persona="miembro">Agregar Miembro</button>
            @break
            @case('direccion_firma')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_persona" data-tipo-persona="direccion_firma">Agregar Miembro de Órgano de Dirección y Administración de Firmas</button>
            @break
            @case('apoderado')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_persona" data-tipo-persona="apoderado">Agregar Apoderado</button>
            @break
        @endswitch
    <br>
    <br>
    @endif

    <div>
        <table style="width:100%" class="yajra-personas-{{$tipo_persona}} table table-hover  table-striped table-condensed">
            <thead>
                <tr>
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    @if($tipo_persona=='direccion_firma')
                        <th>Cargo</th>
                    @endif
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

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

    <script type="text/javascript">
        $(document).ready(function () {
            let tipo_persona = @json($tipo_persona);
            if(tipo_persona!='direccion_firma')
                $('.yajra-personas-{{$tipo_persona}}').DataTable({
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
                    ajax: "{{ url('personas/'.$tipo_persona.'/'.$id.'/'.$mode) }}",
                    columns: [
                        {data: 'apellido_persona', name: 'apellido_persona'},
                        {data: 'nombre_persona', name: 'nombre_persona'},
                        {   data: 'dni_persona',
                            name: 'dni_persona',
                            render: function (data)
                            {
                                return data.replace(/\D/g, "")
                                            .replace(/([0-9])([0-9]{3})$/, '$1.$2')
                                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
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
            else
                 $('.yajra-personas-direccion_firma').DataTable({
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
                    ajax: "{{ url('personas/'.$tipo_persona.'/'.$id.'/'.$mode) }}",
                    columns: [
                        {data: 'apellido_persona', name: 'apellido_persona'},
                        {data: 'nombre_persona', name: 'nombre_persona'},
                        {data: 'dni_persona', name: 'dni_persona'},
                        {data: 'pivot.rol_persona_proveedor', name: 'cargo_persona'},
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });
        });

        function verPersona(elemento) {
            console.log("**detecta evento click en edit_persona");
            var id_proveedor=elemento.data('id-proveedor');
            var tipo_persona=elmento.data('tipo-persona');
            var id_persona=elemento.data('id-persona');
            console.log("id_proveedor = "+id_proveedor);
            let url = '{{ url("proveedor/:id_proveedor/:tipo_persona/:id_persona.") }}';
            url = url.replace(':id_proveedor', id_proveedor);
            url = url.replace(':tipo_persona', tipo_persona);
            url = url.replace(':id_persona', id_persona);
            console.log(url);
            $.ajax({
                url: url,
                success: function(response) {
                    abrirModalverPersona(response);
                }
            });
        }


    </script>
@endpush
