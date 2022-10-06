<div class="row">
    <div class="col-sm"></div>
    <div class="col-sm ui-widget">
        <label for="disposicion_actividad_{{$mode}}">Nro Disposición: <sup>*</sup></label><br>
        <input type="text" class="form-control disposicion_actividad" placeholder="Ingrese el número de disposición" aria-describedby="basic-addon1" id="disposicion_actividad_{{$mode}}" name="nro_disposicion_actividad"
            @if ( $mode == "show") readonly @endif value="" maxlength="50">
    </div>
</div>
<br>

<label for="tipo_actividad_{{$mode}}">Tipo de Actividad:</label><br>
    <select @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1" id="tipo_actividad_{{$mode}}" name="tipo_actividad">
        @forelse($tipos_actividades as $tipo_actividad)
            <option value="{{$tipo_actividad->desc_tipo_actividad}}">{{$tipo_actividad->desc_tipo_actividad}}</option>
        @empty
            <option value=" "></option>
        @endforelse
    </select>
<br>

<label for="actividad_{{$mode}}">Actividad:</label><br>
<select  class=" js-example-basic-single"  @if ( $mode == "show") disabled @endif  id="actividad_{{$mode}}" name="actividad_1">
    @forelse($actividades as $actividad)
        <option value="{{$actividad->desc_actividad}}">{{$actividad->cod_actividad}} - {{$actividad->desc_actividad}}</option>
    @empty
        <option value=" "></option>
    @endforelse
</select>
<br>