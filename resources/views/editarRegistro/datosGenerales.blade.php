<fieldset>

    <h1>Datos generales</h1><br>

    <label for="razon_social">Razón social: <sup>*</sup></label><br>
    <input type="text" class="form-control" placeholder="Ingrese la razón social" aria-describedby="basic-addon1" id="razon_social" name="razon_social"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->razon_social) ? $proveedor->razon_social : '' }}" maxlength="50" autofocus required>
<small class="small" id="small-razon_social"></small>
<br>

    <label for="nombre_fantasia">Nombre de fantasía: <sup>*</sup></label><br>
    <input type="text" class="form-control" placeholder="Ingrese el nombre de fantasía" aria-describedby="basic-addon1" id="nombre_fantasia" name="nombre_fantasia"
        @if ( $mode == "show") readonly @endif
value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" maxlength="50" required>
<small class="small" id="small-nombre_fantasia"></small>
<br>

    <label for="cuit">CUIT: <sup>*</sup></label><br>
    <input type="text" class="form-control" placeholder="Ingrese el número de cuit de la empresa (sin guiones medios)" aria-describedby="basic-addon1" id="cuit" name="cuit"
        @if ( $mode == "show") readonly @endif
value=@if(isset($proveedor->cuit))"{{$proveedor->cuit}}"@elseif(isset($cuit))"{{$cuit}}"@endif maxlength="13" pattern="^([0-9]{2})-([0-9]{8})-([0-9]{1})$" required>
    <small class="small" id="small-cuit-vacio"></small>
    <small class="small" id="small-cuit-mal-formato"></small>
    <br>

    <label for="observaciones">Observaciones:</label><br>
    <textarea id="observaciones"   @if ( $mode == "show") readonly @endif name="observaciones" class="form-control" placeholder="Ingrese las observaciones que considere necesarias" maxlength="200">{{ isset($proveedor->observaciones) ? $proveedor->observaciones : '' }}</textarea>
    <br>
    <hr>
    <br>
    
    @if($mode=='create')
        <input type="button" id="next_datos" name="next" class="next btn btn-info" value="Siguiente"/>
    @else
        <div class="row navbuttons">
            <div class="col-6 col-sm-auto" id="btnNext">
                <a class="btn btn-primary btnNext">Siguiente</a>
            </div>
        </div>
    @endif
</fieldset>
