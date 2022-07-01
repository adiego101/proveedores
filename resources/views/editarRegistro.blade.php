@extends('layouts')

@section('content2')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <nav>
        <ul class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <li class="nav-item">
                <a class=" nav-link @if (empty($tab)) {{ 'active' }} @endif" id="datos-generales-tab"
                    data-toggle="tab" href="#datos-generales">Datos Generales</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link" id="domicilioReal-tab" data-toggle="tab" href="#domicilioReal">Domicilio Real</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="domicilioLegal-tab" data-toggle="tab" href="#domicilioLegal">Domicilio Legal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="domicilioFiscal-tab" data-toggle="tab" href="#domicilioFiscal">Domicilio fiscal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if ($tab == 'actividad') {{ 'active' }} @endif" id="actividad-tab"
                    data-toggle="tab" href="#actividad">Actividad</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if ($tab == 'pago') {{ 'active' }} @endif" id="pagos-tab"
                    data-toggle="tab" href="#pagos">Pagos</a>
            </li>
        </ul>

        <br>

    </nav>

    <small class="small" id="small-razon_social"></small>
    <small class="small" id="small-nombre_fantasia"></small>
    <small class="small" id="small-cuit4"></small>
    <small class="small" id="small-cuit2"></small>
    <small class="small" id="small-dni"></small>

    <form id="edit_form" action="{{ url('editarProveedor/' . $proveedor->id_proveedor) }}" method="POST">
        @csrf

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade  @if (empty($tab)) {{ 'show active' }} @endif" id="datos-generales"
                role="tabpanel" aria-labelledby="nav-datos-generales-tab">
                @include('editarRegistro.datosGenerales')
            </div>
            <div class="tab-pane fade" id="domicilioReal" role="tabpanel" aria-labelledby="nav-domicilioReal-tab">
                @include('editarRegistro.domicilioReal')
            </div>
            <div class="tab-pane fade" id="domicilioLegal" role="tabpanel" aria-labelledby="nav-domicilioLegal-tab">
                @include('editarRegistro.domicilioLegal')

            </div>
            <div class="tab-pane fade" id="domicilioFiscal" role="tabpanel"
                aria-labelledby="nav-domicilioFiscal.blade-tab">
                @include('editarRegistro.domicilioFiscal')
            </div>
            <div class="tab-pane fade @if ($tab == 'actividad') {{ 'show active' }} @endif " id="actividad"
                role="tabpanel" aria-labelledby="nav-actividad-tab">
                @include('editarRegistro.actividad')
            </div>
            <div class="tab-pane fade  @if ($tab == 'pago') {{ 'show active' }} @endif" id="pagos"
                role="tabpanel" aria-labelledby="nav-pagos-tab">
                @include('editarRegistro.pagos')
            </div>

        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <div class="btn-group">
                <button type="submit" name="finalizar" class="btn btn-success"> {{ 'Finalizar' }} </button>
               
            </div>
        </div>

    </form>

    @include('edicionesModales.editarpagos')
    @include('edicionesModales.pagos')
    @include('edicionesModales.editarActividades')
    @include('edicionesModales.actividades')

    @yield('datos')

@endsection

@push('js')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css" integrity="sha512-CbQfNVBSMAYmnzP3IC+mZZmYMP2HUnVkV4+PwuhpiMUmITtSpS7Prr3fNncV1RBOnWxzz4pYQ5EAGG4ck46Oig==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
    let formulario = document.getElementById("edit_form");

formulario.addEventListener("submit", function(event){

        //Detenemos el envio del formulario
        event.preventDefault();


            if(validarDni()){
                                  
                this.submit();              
            }

}, false);

        $('input[type="checkbox"]').on('change', function() {
            this.value = this.checked ? 1 : 0;
            //console.log(this.value);
        }).change();

        $('.btnNext').click(function() {
            $('.nav-tabs .active').parent().next('li').find('a').trigger('click');
        })

        $('.btnPrevious').click(function() {
            $('.nav-tabs .active').parent().prev('li').find('a').trigger('click');
        })
    </script>
    <script type="text/javascript">

        function valideKey(evt) {

            // El código es la representación decimal ASCII de la clave presionada.
            var code = (evt.which) ? evt.which : evt.keyCode;

            if (code == 8) { // espacio.
                return true;
            } else if (code >= 48 && code <= 57) { // es un numero.
                return true;
            } else { // otras teclas
                //console.log("no es un numero");
                return false;
            }
        }
    </script>

    <script>
        $('input[type="checkbox"]').on('change', function() {
            this.value = this.checked ? 1 : 0;
            //console.log(this.value);
        }).change();

        window.onload = function() {

            validar_razon_social();

            validar_nombre_fantasia();

            validar_cuit();

          $('.js-example-basic-single').select2({
            theme: "bootstrap",    width: 'resolve' // need to override the changed default
});


$("#dni_legal").val(function (index, value ) {
    return value.replace(/\D/g, "")
                .replace(/([0-9])([0-9]{3})$/, '$1.$2')
                .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
});

$("#cuit").val(function (index, value ) {
    return value.replace(/\D/g, "")
                .replace(/([0-9])([0-9]{1})$/, '$1-$2')
                .replace(/^([0-9]{2})/, '$1-')

});

            @if (!$proveedor_domicilio_real->id_localidad == '')
                recargarListaRealEdit2();
            @endif
            @if (!$proveedor_domicilio_fiscal->id_localidad == '')
                recargarListaFiscal2();
            @endif

            @if (!$proveedor_domicilio_legal->id_localidad == '')
                recargarListaLegal2();
            @endif

            @if (!$proveedor->localidad_habilitacion == '')
                recargarListaHabilitacion2();
            @endif


        };

    </script>

@endpush

@push('css')
    <style>
        .progress-bar {
            background-color: #17a2b8;
            color: #000;
        }

    </style>
@endpush

@push('css')

    <style>
        input:invalid:required {

            border: 1px dashed red;
        }

        input:hover:invalid:required {

            background-color: rgb(255, 76, 76);
        }
    </style>

@endpush
