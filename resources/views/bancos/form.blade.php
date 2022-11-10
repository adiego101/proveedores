
<label for="nombre_banco_{{$mode}}">Banco con el que opera:</label><br>
<div class="form-group">
    <select class="js-example-basic-single" aria-describedby="basic-addon1" id="nombre_banco_{{$mode}}" name="nombre_banco">
        <option value="">Seleccione un banco</option>
        @foreach($bancos as $banco)
            <option value="{{$banco->nombre_banco}}">{{$banco->nombre_banco}}</option>
        @endforeach
    </select>
    <small class="small" id="small-banco-{{$mode}}"></small>
</div>

<label>Sucursal</label><br>
<div class="row">
    <div class="col-sm">
        <label for="provincia_sucursal_{{$mode}}">Provincia:</label><br>
        <select class="js-example-basic-single" aria-describedby="basic-addon1" id="provincia_sucursal_{{$mode}}" name="provincia_sucursal">
            <option value=" ">Seleccione una provincia</option>
            @foreach($provincias as $provincia)
                <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm">
        <label for="localidad_sucursal_{{$mode}}">Localidad:</label><br>
        <div class="form-group">
            <select class="js-example-basic-single" aria-describedby="basic-addon1" id="localidad_sucursal_{{$mode}}" name="localidad_sucursal">
                <option value="">Seleccione una localidad</option>
            </select>
            <small class="small" id="small-localidad-sucursal-{{$mode}}"></small>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <label for="tipo_cuenta_{{$mode}}">Tipo de cuenta:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese el tipo de cuenta" aria-describedby="basic-addon1" id="tipo_cuenta_{{$mode}}" name="tipo_cuenta" maxlength="50">
        <small class="small" id="small-tipo-cuenta-{{$mode}}"></small>
    </div>
    <div class="col-sm">
        <label for="nro_cuenta_{{$mode}}">Nº de cuenta:</label><br>
        <input type="text" class="form-control" placeholder="Ingrese el Nº de cuenta" aria-describedby="basic-addon1" id="nro_cuenta_{{$mode}}" name="nro_cuenta" maxlength="50">
        <small class="small" id="small-nro-cuenta-{{$mode}}"></small>
    </div>
</div>
