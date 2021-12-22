<fieldset>

    <h1>Datos generales</h1><br>

    <label for="razon_social">Razón social:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese la razón social" aria-describedby="basic-addon1" id="razon_social" name="razon_social"
        value="{{ isset($proveedor->razon_social) ? $proveedor->razon_social : '' }}"  autofocus><br>

    <label for="nombre_fantasia">Nombre de fantasía:</label><br>
    <input type="text" class="form-control" placeholder="Ingrese el nombre de fantasía" aria-describedby="basic-addon1" id="nombre_fantasia"  name="nombre_fantasia"
        value="{{ isset($proveedor->nombre_fantasia) ? $proveedor->nombre_fantasia : '' }}" ><br>

    <label for="cuit">Cuit:</label><br>
    <input type="number" class="form-control"  onkeypress="return valideKey(event);" placeholder="Ingrese el número de cuit de la empresa" aria-describedby="basic-addon1" id="cuit" name="cuit"
        value="{{ isset($proveedor->cuit) ? $proveedor->cuit : '' }}" ><br>

        <div class="row navbuttons pt-5">
            <div class="col-6 col-sm-auto" id="btnNext">
                <a class="btn btn-primary btnNext">Siguiente</a>

                <!--DEJAR COMENTADO HASTA LA EXPOSICION -->
               <!-- <a href="{{url('registro-alta/'.$id)}}" class="btn btn-success">Descargar Registro alta</a>
                <a href="{{url('certificado-inscripcion/'.$id)}}" class="btn btn-warning">Descargar Certificado inscripción</a> -->
            </div>
        </div>
</fieldset>
