<fieldset>
<div class="row">
        <h1>Actividad</h1>
</div>

<br/>
    <div class="row">
        <div class="col-sm">
            <!--En este caso, se deben recuperar los tipos de actividad de la BD -->
            <label for="tipo_actividad">Tipo de Actividad:</label><br>
                <select class="form-control" aria-describedby="basic-addon1" id="tipo_actividad" name="tipo_actividad">
                    @forelse($tipos_actividades as $tipo_actividad)
                        <option value="{{$tipo_actividad->desc_tipo_actividad}}">{{$tipo_actividad->desc_tipo_actividad}}</option>
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
            <br />
        </div>

        <div class="col-sm">

            <!--En este caso, se deben recuperar las actividades de la BD -->
            <label for="actividad">Actividad:</label><br>
            <select class="form-control" aria-describedby="basic-addon1" id="actividad" name="actividad">
                @forelse($actividades as $actividad)
                    <option value="{{$actividad->desc_actividad}}">{{$actividad->desc_actividad}}</option>
                @empty
                    <option value=" "></option>
                @endforelse
            </select>
            <br />

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a id="add_actividad" class="btn btn-success">Agregar Actividad</a>
            </div>
        </div>
    </div>
    <br>
</fieldset>
