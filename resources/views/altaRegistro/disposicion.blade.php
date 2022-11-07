<fieldset>
    <h1>Datos de la disposición</h1><br>
    @include('disposiciones.form')
    <br>
    <input type="button" name="next" class="next btn btn-info" value="Siguiente" data-tipo='disposicion'/>
</fieldset>

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#tipo_disposicion").change(function(){
                if($("#tipo_disposicion").val!='')
                {
                    $("#tipo_disposicion").css('border', '1px solid #ccc');
                    $('#small-tipo-disposicion-head').empty();
                }
                else
                    $("#tipo_disposicion").css('border', '1px dashed red');
            });
            $("#nro_expte_gde").keyup(function(){
                ocultarError('#nro_expte_gde', '#small-nro-expte-head');
            });
            $("#fecha_inicio_disposicion").change(function(){
                ocultarError('#fecha_inicio_disposicion', '#small-inicio-disposicion-head');
            });
            $("#fecha_fin_disposicion").change(function(){
                ocultarError('#fecha_fin_disposicion', '#small-fin-disposicion-head');
            });
        })
    </script>
@endpush