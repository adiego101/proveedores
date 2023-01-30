<fieldset>
    <h1>Datos de la disposición</h1><br>
    @include('disposiciones.form')
    <br>
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" data-tipo='disposicion'/>
</fieldset>

@push('js')

<script>
    function ValidarFechas()
    {
       var fechainicial = $("#fecha_inicio_disposicion_{{ $mode }}").val();
       var fechafinal = $("#fecha_fin_disposicion_{{ $mode }}").val();

       if(Date.parse(fechafinal) < Date.parse(fechainicial)) {

       alert("La fecha final debe ser mayor a la fecha inicial");
       return 0;
    }
    else{
        return 1;
    }
}
</script>

    <script type="text/javascript">
        $(document).ready(function(){



            $("#tipo_disposicion_{{$mode}}").change(function(){
                if($("#tipo_disposicion_{{$mode}}").val().trim() === '')
                {
                    $("#tipo_disposicion_{{$mode}}").css('border', '1px dashed red');
                    mostrarError('#tipo_disposicion_{{$mode}}', '#small-tipo-disposicion-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El TIPO DE DISPOSICION <strong>no</strong> puede quedar vacío.</div>');

                    return false;
                }
                    $("#tipo_disposicion_{{$mode}}").css('border', '1px solid #ccc');
                    ocultarError('#tipo_disposicion_{{$mode}}', '#small-tipo-disposicion-{{$mode}}');
                    ocultarError('#tipo_disposicion_{{$mode}}', '#small-tipo-disposicion-head');

                    return true;
            });
            $("#nro_expte_gde_create").keyup(function(){
                ocultarError('#nro_expte_gde_create', '#small-nro-expte-head');
            });
            $("#fecha_inicio_disposicion_{{$mode}}").change(function(){
                ocultarError('#fecha_inicio_disposicion', '#small-inicio-disposicion-head');
            });
            $("#fecha_fin_disposicion_{{$mode}}").change(function(){
                ocultarError('#fecha_fin_disposicion', '#small-fin-disposicion-head');
            });
        })
    </script>
@endpush
