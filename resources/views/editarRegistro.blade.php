@extends('layouts')

@section('content2')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    {{--
    <div class="alert alert-info" role="alert">
        Modifique los campos que se presentan continuación
        y presione el botón <b>Siguiente</b>, para continuar la modificación de los datos.
    </div>--}}

    <nav>
        <ul class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <li class="nav-item">
                <a class=" nav-link active" id="datos-generales-tab" data-toggle="tab"
                    href="#datos-generales">Datos Generales</a>
            </li>
            <li class="nav-item">
                <a class=" nav-link" id="domicilioReal-tab" data-toggle="tab"
                    href="#domicilioReal">Domicilio Real</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="domicilioLegal-tab" data-toggle="tab"
                    href="#domicilioLegal">Domicilio Legal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="sucursales-tab" data-toggle="tab"
                    href="#sucursales">Sucursales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="infoImpositiva-tab" data-toggle="tab"
                    href="#infoImpositiva">Informacion Impositiva</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="ingresosbrutos-tab" data-toggle="tab"
                    href="#ingresosbrutos">Impuestos sobre ingresos brutos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="domicilioFiscal-tab" data-toggle="tab"
                    href="#domicilioFiscal">Domicilio fiscal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="actividad-tab" data-toggle="tab"
                    href="#actividad">Actividad</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="valorAgregado-tab" data-toggle="tab"
                    href="#valorAgregado">Valor Agregado</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="personalOcupado-tab" data-toggle="tab"
                    href="#personalOcupado">Personal Ocupado</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="pagos-tab" data-toggle="tab" href="#pagos">Pagos</a>
            </li>

            <li class="nav-item">
                <a class="nav-link " id="otrosDatos-tab" data-toggle="tab" href="#otrosDatos">Otros
                    Datos</a>
            </li>

        </ul>

        <br>
        <!-- -->

    </nav>

    <form id="regiration_form" action="{{url('editarProveedor/'.$proveedor->id_proveedor)}}"  method="POST">
        @csrf

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="datos-generales" role="tabpanel"
                            aria-labelledby="nav-datos-generales-tab">
                            @include('editarRegistro.datosGenerales')
                        </div>
                        <div class="tab-pane fade" id="domicilioReal" role="tabpanel"
                            aria-labelledby="nav-domicilioReal-tab">
                            @include('editarRegistro.domicilioReal')
                        </div>
                        <div class="tab-pane fade" id="domicilioLegal" role="tabpanel"
                            aria-labelledby="nav-domicilioLegal-tab">
                            @include('editarRegistro.domicilioLegal')

                        </div>
                        <div class="tab-pane fade" id="sucursales" role="tabpanel" aria-labelledby="nav-sucursales-tab">
                            {{--@include('editarRegistro.sucursales')--}}
                        </div>
                        <div class="tab-pane fade" id="infoImpositiva" role="tabpanel"
                            aria-labelledby="nav-infoImpositiva-tab">
                            {{--@include('editarRegistro.infoImpositiva')--}}
                        </div>
                        <div class="tab-pane fade" id="ingresosbrutos" role="tabpanel"
                            aria-labelledby="nav-ingresosbrutos-tab">
                            {{--@include('editarRegistro.ingresosbrutos')--}}
                        </div>
                        <div class="tab-pane fade" id="domicilioFiscal" role="tabpanel"
                            aria-labelledby="nav-domicilioFiscal.blade-tab">
                            @include('editarRegistro.domicilioFiscal')
                        </div>
                        <div class="tab-pane fade" id="actividad" role="tabpanel" aria-labelledby="nav-actividad-tab">
                           {{-- @include('editarRegistro.actividad')--}}
                        </div>
                        <div class="tab-pane fade" id="valorAgregado" role="tabpanel"
                            aria-labelledby="nav-valorAgregado-tab">
                            @include('editarRegistro.valorAgregado')

                        </div>
                        <div class="tab-pane fade" id="personalOcupado" role="tabpanel"
                            aria-labelledby="nav-personalOcupado-tab">
                            @include('editarRegistro.personalOcupado')
                        </div>
                        <div class="tab-pane fade" id="pagos" role="tabpanel" aria-labelledby="nav-pagos-tab">
                            {{--@include('editarRegistro.pagos')--}}
                        </div>

                            <div class="tab-pane fade" id="otrosDatos" role="tabpanel"
                                aria-labelledby="nav-otrosDatos-tab">
                                @include('editarRegistro.otrosDatos') </div>
                        </div>






                        <button type="submit" name="finalizar" class="btn btn-success"> {{ 'Finalizar' }} </button>

    </form>
    @yield('datos')

@endsection

@push('js')
    <script>
        $('input[type="checkbox"]').on('change', function() {
            this.value = this.checked ? 1 : 0;
            console.log(this.value);
        }).change();

        $('.btnNext').click(function() {
    $('.nav-tabs .active').parent().next('li').find('a').trigger('click');
})

$('.btnPrevious').click(function() {
    $('.nav-tabs .active').parent().prev('li').find('a').trigger('click');
})
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
        console.log("no es un numero");
          return false;
        }
    }
    </script>

<script>

$('input[type="checkbox"]').on('change', function(){
    this.value = this.checked ? 1 : 0;
     console.log(this.value);
 }).change();
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

