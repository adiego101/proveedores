<label for="nombre_sucursal">Nombre Sucursal:</label><br />
<input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->nombre_sucursal) ? $sucursal->nombre_sucursal : '' }}" placeholder="Ingrese el nombre de la sucursal" aria-describedby="basic-addon1" id="nombre_sucursal" name="nombre_sucursal" maxlength="50" required/><br />

<div class="row">
    <div class="col-sm">
        <label for="calle">Calle:</label><br />
        <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->calle) ? $sucursal->calle : '' }}" placeholder="Ingrese la calle de la sucursal" aria-describedby="basic-addon1" id="calle" name="calle" maxlength="50"/><br />

        <label for="dpto">Departamento:</label><br />
        <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->dpto) ? $sucursal->dpto : '' }}" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto" name="dpto" maxlength="10"/><br />

        <label for="lote">Lote:</label><br />
        <input @if ( $mode == "show") readonly @endif  type="text" onkeypress="return valideKey(event);" class="form-control" value="{{ isset($sucursal->lote) ? $sucursal->lote : '' }}" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote" name="lote" maxlength="4"/><br />

        <label for="entre_calles">Entre Calles:</label><br />
        <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->entre_calles) ? $sucursal->entre_calles : '' }}" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entre_calles" name="entre_calles" maxlength="70"/><br />

        <label for="monoblock">Monoblock:</label><br />
        <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->monoblock) ? $sucursal->monoblock : '' }}" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock" name="monoblock" maxlength="10"/><br />

        <label for="pais">Pais:</label><br>
            <select  @if ( $mode == "show") disabled @endif   class="form-control" aria-describedby="basic-addon1" id="pais" name="pais" required>
                @forelse($paises as $pais)
                    @if(isset($sucursal->localidad->provincia->pais->nombre_pais) && $sucursal->localidad->provincia->pais->nombre_pais==$pais->nombre_pais)
                        <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @else
                        <option value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @endif
                @empty
                    <option value=" "></option>
                @endforelse
            </select>
            <br>

            <label for="id_localidad">Localidad:</label><br>
            <select  @if ( $mode == "show") disabled @endif  class="form-control {{$mode}}"  aria-describedby="basic-addon1" id="id_localidad" name="id_localidad" required>
                <option value="">Seleccione una localidad</option>
                @forelse($localidades as $localidad)
                    @if (isset($sucursal->localidad) && $sucursal->localidad->nombre_localidad==$localidad->nombre_localidad)
                        <option selected="selected" value="{{$localidad->id_localidad}}">{{$localidad->nombre_localidad}}</option>
                    @else
                        <option value="{{$localidad->id_localidad}}">{{$localidad->nombre_localidad}}</option>
                    @endif
                @empty
                    <option value=" "></option>
                @endforelse
            </select>
            <br>

            <label for="email">Correo electrónico:</label><br>
            @if(isset($sucursal->emails))
                @foreach($sucursal->emails as $email)
                    <input @if ( $mode == "show") readonly @endif  id="email" value="{{ isset($email->email) ? $email->email : '' }}" type="email" class="form-control email" placeholder="ejemplo@dominio.com"
                    name="email" aria-describedby="basic-addon1" maxlength="50"><br>
                @endforeach
            @else
                <input @if ( $mode == "show") readonly @endif  id="email" value="{{ isset($email->email) ? $email->email : '' }}" type="email" class="form-control email" placeholder="ejemplo@dominio.com"
                    name="email" aria-describedby="basic-addon1" maxlength="50"><br>
                <div class="field_email">

                </div>
            @endif

    </div>

    <div class="col-sm">
        <label for="numero">Número:</label><br />
        <input @if ( $mode == "show") readonly @endif  type="text" onkeypress="return valideKey(event);" class="form-control" value="{{ isset($sucursal->numero) ? $sucursal->numero : '' }}" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero" name="numero" maxlength="5"/><br />

        <label for="puerta">Puerta:</label><br />
        <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->puerta) ? $sucursal->puerta : '' }}" placeholder="Ingrese el número de puerta" aria-describedby="basic-addon1" id="puerta" name="puerta" maxlength="4"/><br />

        <label for="manzana">Manzana:</label><br />
        <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->manzana) ? $sucursal->manzana : '' }}" placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana" name="manzana" maxlength="5"/><br />

        <label for="oficina">Oficina:</label><br />
        <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->oficina) ? $sucursal->oficina : '' }}" placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina" name="oficina" maxlength="4"/><br />

        <label for="barrio">Barrio:</label><br />
        <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->barrio) ? $sucursal->barrio : '' }}" placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio" name="barrio" maxlength="50"/><br />

        <label for="provincia">Provincia:</label><br>
        <select  @if ( $mode == "show") disabled @endif  class="form-control {{$mode}}" value="{{ isset($sucursal->poliza) ? $sucursal->poliza : '' }}" aria-describedby="basic-addon1" id="provincia" name="provincia" required>
            <option selected value="">Seleccione una provincia</option>
                @forelse($provincias as $provincia)
                    @if (isset($sucursal->localidad->provincia) && $sucursal->localidad->provincia->nombre_provincia==$provincia->nombre_provincia)
                        <option selected="selected" value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                    @else
                        <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                    @endif
                @empty
                    <option value=" "></option>
                @endforelse
        </select>
        <br>

        <label for="codigo_postal">Código Postal:</label><br>
        <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->codigo_postal) ? $sucursal->codigo_postal : '' }}" aria-describedby="basic-addon1" id="codigo_postal" name="codigo_postal" placeholder="Ingrese el código postal" maxlength="8"><br>

        <label for="nro_tel">Teléfono:</label><br>
        @if(isset($sucursal->telefonos))
            @foreach($sucursal->telefonos as $telefono)
                <div class="row">
                    <div class="col-sm">
                        <label for="telefono_sucursal_cod">Código de área:</label><br>
                        <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ej: 2966" aria-describedby="basic-addon1" id="telefono_sucursal_cod" maxlength="4" value="{{ isset($telefono->cod_area_tel) ? $telefono->cod_area_tel : '' }}">
                    </div>
                    <div class="col-sm">
                        <label for="telefono_sucursal">Número de Teléfono:</label><br>
                        <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Teléfono" aria-describedby="basic-addon1" id="telefono_sucursal" maxlength="14" value="{{ isset($telefono->nro_tel) ? $telefono->nro_tel : '' }}">
                    </div>
                </div>
            @endforeach
        @else
            <div class="row">
                <div class="col-sm">
                    <label for="telefono_sucursal_cod">Código de área:</label><br>
                    <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ej: 2966" aria-describedby="basic-addon1" id="telefono_sucursal_cod" maxlength="4" value="{{ isset($telefono->cod_area_tel) ? $telefono->cod_area_tel : '' }}">
                </div>
                <div class="col-sm">
                    <label for="telefono_sucursal">Número de Teléfono:</label><br>
                    <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Teléfono" aria-describedby="basic-addon1" id="telefono_sucursal" maxlength="14" value="{{ isset($telefono->nro_tel) ? $telefono->nro_tel : '' }}">
                </div>
            </div>
        <!--    <div class="field_telefono d-grid gap-2 d-md-flex justify-content-md-center">
                <a href="javascript:void(0);" class="add_telefono" title="Agregue un nuevo teléfono"> <input @if ( $mode == "show") readonly @endif  type="button" value="Agregar Teléfono" class="btn btn-success"></a>
            </div> -->
        
        @endif
        <br>
        <input type="hidden" id="editar_sucursal">

        <input type="hidden" id="id_sucursal" value={{isset($sucursal) ? $sucursal->id_sucursal : '' }}>
    </div>
</div>
