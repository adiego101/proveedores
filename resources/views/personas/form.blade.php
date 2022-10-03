<div class="ui-widget">
    <label for="dni_{{$tipo_persona}}_{{$mode}}">DNI:</label><br>
    <input type="text" class="form-control dni" placeholder="Ingrese el dni" @if ( $mode == "show") readonly @endif
        aria-describedby="basic-addon1" id="dni_{{$tipo_persona}}_{{$mode}}" name="dni_persona" data-tipo-persona="{{$tipo_persona}}" data-mode={{$mode}} maxlength="10" autocomplete="off">
    <small class="small" id="small-dni-{{$tipo_persona}}-{{$mode}}"></small>
</div>
<br>

<label for="apellido_{{$tipo_persona}}_{{$mode}}">Apellido:</label><br>
<input type="text" @if ( $mode == "show") readonly @endif class="form-control" 
    placeholder="Ingrese el apellido" aria-describedby="basic-addon1" id="apellido_{{$tipo_persona}}_{{$mode}}" name="apellido_persona" maxlength="50">
<small class="small" id="small-apellido-{{$tipo_persona}}-{{$mode}}"></small><br>


<label for="nombre_{{$tipo_persona}}_{{$mode}}">Nombre:</label><br>
<input type="text" @if ( $mode == "show") readonly @endif class="form-control" 
    placeholder="Ingrese el nombre" aria-describedby="basic-addon1" id="nombre_{{$tipo_persona}}_{{$mode}}" name="nombre_persona" maxlength="50">
<small class="small" id="small-nombre-{{$tipo_persona}}-{{$mode}}"></small><br>
<div id="div_cargo_{{$tipo_persona}}_{{$mode}}" @if($tipo_persona!='direccion_firma')style="display:none;"@endif>
    <label for="cargo_{{$tipo_persona}}_{{$mode}}">Cargo:</label><br>
    <input type="text" @if ( $mode == "show") readonly @endif class="form-control" 
    placeholder="Ingrese el cargo" aria-describedby="basic-addon1" id="cargo_{{$tipo_persona}}_{{$mode}}" name="cargo_persona" maxlength="50">
    <small class="small" id="small-cargo-{{$tipo_persona}}-{{$mode}}"></small><br>
</div>