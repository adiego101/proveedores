{{--
    <div class="row">
    <div class="col-sm"></div>
    <div class="col-sm ui-widget">

    </div>
</div>
--}}
<label for="disposiciones">Disposiciones: </label><br>
<select class="dispos form-control"  name="disposiciones" id="disposiciones" aria-label="Default select example">
    <option selected>Seleccione una Disposicion</option>
</select>
<br>

<label for="tipo_actividad_{{$mode}}">Tipo de Actividad:</label><br>
    <select @if ( $mode == "show") disabled @endif class="form-control" aria-describedby="basic-addon1" id="tipo_actividad_{{$mode}}" name="tipo_actividad">
        <option selected>Seleccione el Tipo de Actividad</option>
        @forelse($tipos_actividades as $tipo_actividad)
            <option value="{{$tipo_actividad->desc_tipo_actividad}}">{{$tipo_actividad->desc_tipo_actividad}}</option>
        @empty
            <option value=" "></option>
        @endforelse
    </select>
<br>

<label for="actividad_{{$mode}}">Actividad:</label><br>
<select  class="js-example-basic-single"  @if ( $mode == "show") disabled @endif  id="actividad_{{$mode}}"  name="actividad_1">
        <option selected>Seleccione una Actividad</option>
    @forelse($actividades as $actividad)
        <option value="{{$actividad->desc_actividad}}">{{$actividad->cod_actividad}} - {{$actividad->desc_actividad}}</option>
    @empty
        <option value=" "></option>
    @endforelse
</select>
<br>
