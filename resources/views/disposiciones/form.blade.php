<div class="row">
    <div class="col-sm"></div>
    <div class="col-sm">
        <label for="nro_expte_gde_{{ $mode }}">Nro Expediente GDE: <sup>*</sup></label><br>
        <input type="text" class="form-control" placeholder="Ingrese el número de expediente de GDE"
            aria-describedby="basic-addon1" id="nro_expte_gde_{{ $mode }}" name="nro_expte_gde"
            @if ($mode == 'modal-show') readonly @endif value="" maxlength="50"
            @if ($mode == 'create') autofocus required @endif>
        <small class="small" id="small-nro_expte_gde_{{ $mode }}"></small>

    </div>
</div>
<br>
<div class="row">
    <div class="col-sm">
        <label for="tipo_disposicion_{{ $mode }}">Tipo de disposición: <sup>*</sup></label><br>
        <select name="tipo_disposicion" @if ($mode == 'modal-show') readonly @endif @if ($mode == 'create') required @endif id="tipo_disposicion_{{ $mode }}"
            class="form-control" aria-label="Tipo disposicion">
            <option value="">Seleccione un tipo de disposicion</option>
            <option value="inscripcion">INSCRIPCION</option>
            @if($mode != "create")
                <option value="renovacion">RENOVACION</option>
                <option value="AMPLIACION">AMPLIACION</option>
                <option value="BAJA">BAJA</option>
            @endif
        </select>
        <small class="small" id="small-tipo-disposicion-{{ $mode }}"></small>
    </div>
    <div class="col-sm">
        <label for="nro_disposicion_{{ $mode }}">Nro Disposición: <sup>*</sup></label><br>
        <input type="text" class="form-control" placeholder="Ingrese el número de disposición"
            aria-describedby="basic-addon1" id="nro_disposicion_{{ $mode }}" name="nro_disposicion"
            @if ($mode == 'modal-show') readonly @endif value="" maxlength="50"
            @if ($mode == 'create') autofocus required @endif>
        <small class="small" id="small-nro-disposicion-{{ $mode }}"></small>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm">
        <label for="fecha_inicio_disposicion_{{ $mode }}">Fecha inicio de vigencia: <sup>*</sup></label><br>
        <input type="date" class="form-control" placeholder="Ingrese la razón social" aria-describedby="basic-addon1"
            id="fecha_inicio_disposicion_{{ $mode }}" name="fecha_inicio_disposicion"
            @if ($mode == 'modal-show') readonly @endif value=""
            @if ($mode == 'create') autofocus required @endif>
        <small class="small" id="small-fecha-inicio-{{ $mode }}"></small>
    </div>
    <div class="col-sm">
        <label for="fecha_fin_disposicion_{{ $mode }}">Fecha fin de vigencia: <sup>*</sup></label><br>
        <input type="date" class="form-control" placeholder="Ingrese la razón social" aria-describedby="basic-addon1"
            id="fecha_fin_disposicion_{{ $mode }}" name="fecha_fin_disposicion"
            @if ($mode == 'modal-show') readonly @endif value=""
            @if ($mode == 'create') autofocus required @endif>
        <small class="small" id="small-fecha-fin-{{ $mode }}"></small>
    </div>
</div>
<br>
<label for="observaciones_disposicion_{{ $mode }}">Observaciones:</label><br>
<textarea id="observaciones_disposicion_{{ $mode }}" @if ($mode == 'modal-show') readonly @endif
    name="observaciones_disposicion" class="form-control"
    placeholder="Ingrese las observaciones que considere necesarias" maxlength="200"></textarea>
@push('js')
    <script type="text/javascript">
        $('#nro_expte_gde_{{ $mode }}').change(validar_nro_expte_gde);
        $('#fecha_inicio_disposicion_{{ $mode }}').change(validar_fecha_inicio_disposicion);
        $('#fecha_fin_disposicion_{{ $mode }}').change(validar_fecha_fin_disposicion);



        function validar_nro_expte_gde() {

            if ($('#nro_expte_gde_{{ $mode }}').val() == "") {
                console.log("asdasd");

                mostrarError('#nro_expte_gde_{{ $mode }}', '#small-nro_expte_gde_{{ $mode }}',
                    '<div class="alert alert-danger mt-3 pt-1">El NÚMERO DE EXPEDIENTE DE GDE <strong>no</strong> puede quedar vacío.</div>'
                    );

                return false;
            }

            ocultarError('#nro_expte_gde_{{ $mode }}', '#small-nro_expte_gde_{{ $mode }}');

            return true;
        }

        function validar_fecha_inicio_disposicion() {

            if ($('#fecha_inicio_disposicion_{{ $mode }}').val() == "") {
                console.log("asdasd");

                mostrarError('#fecha_inicio_disposicion_{{ $mode }}', '#small-fecha-inicio-{{ $mode }}',
                    '<div class="alert alert-danger mt-3 pt-1">La Fecha inicio de vigencia <strong>no</strong> puede quedar vacía.</div>'
                    );

                return false;
            }

            ocultarError('#fecha_inicio_disposicion_{{ $mode }}', '#small-fecha-inicio-{{ $mode }}');

            return true;
        }

        function validar_fecha_fin_disposicion() {

            if ($('#fecha_fin_disposicion_{{ $mode }}').val() == "") {
                console.log("asdasd");

                mostrarError('#fecha_fin_disposicion_{{ $mode }}', '#small-fecha-fin-{{ $mode }}',
                    '<div class="alert alert-danger mt-3 pt-1">La Fecha fin de vigencia <strong>no</strong> puede quedar vacía.</div>'
                    );

                return false;
            }

            ocultarError('#fecha_fin_disposicion_{{ $mode }}', '#small-fecha-fin-{{ $mode }}');

            return true;
        }
    </script>
@endpush
