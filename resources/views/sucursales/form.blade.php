<label for="nombre_sucursal">Nombre Sucursal:</label><br />
<input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->nombre_sucursal) ? $sucursal->nombre_sucursal : '' }}" placeholder="Ingrese el nombre de la sucursal" aria-describedby="basic-addon1" id="nombre_sucursal" name="nombre_sucursal" maxlength="50" required/><br />

<div class="row">
    <div class="col-sm">
        <label for="calle">Calle:</label><br />
        <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->calle) ? $sucursal->calle : '' }}" placeholder="Ingrese la calle de la sucursal" aria-describedby="basic-addon1" id="calle" name="calle" maxlength="50"/><br />

        <label for="dpto">Departamento:</label><br />
        <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->dpto) ? $sucursal->dpto : '' }}" placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto" name="dpto" maxlength="10"/><br />

        <label for="lote">Lote:</label><br />
        <input @if ( $mode == "show") readonly @endif  type="text" onkeypress="return valideKey(event);" class="form-control" value="{{ isset($sucursal->lote) ? $sucursal->lote : '' }}" placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote" name="lote" maxlength="4"/>
        <small class="small" id="small-lote"></small>

        <br />
        <label for="entre_calles">Entre Calles:</label><br />
        <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->entre_calles) ? $sucursal->entre_calles : '' }}" placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entre_calles" name="entre_calles" maxlength="70"/><br />

        <label for="monoblock">Monoblock:</label><br />
        <input @if ( $mode == "show") readonly @endif  type="text" class="form-control" value="{{ isset($sucursal->monoblock) ? $sucursal->monoblock : '' }}" placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock" name="monoblock" maxlength="10"/><br />

        <label for="pais">Pais:</label><br>
            <select  @if ( $mode == "show") disabled @endif   class="form-control" aria-describedby="basic-addon1" id="pais" name="pais" required>
                <!--<option value="">Seleccione un país</option>-->
                @forelse($paises as $pais)
                    @if(isset($sucursal->localidad->provincia->pais->nombre_pais) && $sucursal->localidad->provincia->pais->nombre_pais==$pais->nombre_pais)
                        <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @else
                        <option value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @endif
                @empty
                    <option value=" ">Seleccione un país</option>
                @endforelse
            </select>
            <br>

            <label for="id_localidad">Localidad:</label><br>
            <select  @if ( $mode == "show") disabled @endif  class="form-control {{$mode}}"  aria-describedby="basic-addon1" id="id_localidad" name="id_localidad" required>
                <option value="">Seleccione una localidad</option>
                @forelse($localidades as $localidad)
                    @if (isset($sucursal->localidad) && $sucursal->localidad->nombre_localidad==$localidad->nombre_localidad)
                        <option selected value="{{$localidad->id_localidad}}">{{$localidad->nombre_localidad}}</option>
                    @else
                        <option value="{{$localidad->id_localidad}}">{{$localidad->nombre_localidad}}</option>
                    @endif
                @empty
                    <option value=" "></option>
                @endforelse
            </select>
            <br>

            <label for="email_sucursales">Correo electrónico:</label><br>
            @if(isset($sucursal->emails))
                @forelse($sucursal->emails as $email)
                    <input @if ( $mode == "show") readonly @endif  id="email_sucursales" value="{{ isset($email->email) ? $email->email : '' }}" type="email" class="form-control email" placeholder="ejemplo@dominio.com"
                    name="email_sucursales" aria-describedby="basic-addon1" maxlength="50"><br>
                @empty
                    <input @if ( $mode == "show") readonly @endif  id="email_sucursales" value="{{ isset($email->email) ? $email->email : '' }}" type="email" class="form-control email" placeholder="ejemplo@dominio.com"
                    name="email_sucursales" aria-describedby="basic-addon1" maxlength="50"><br>
                @endforelse
            @else
                <input @if ( $mode == "show") readonly @endif  id="email_sucursales" value="{{ isset($email->email) ? $email->email : '' }}" type="email" class="form-control email" placeholder="ejemplo@dominio.com"
                    name="email_sucursales" aria-describedby="basic-addon1" maxlength="50"><br>
                <div class="field_email">

                </div>
            @endif

    </div>

    <div class="col-sm">
        <label for="numero">Número:</label><br />
        <input @if ( $mode == "show") readonly @endif  type="text" onkeypress="return valideKey(event);" class="form-control" value="{{ isset($sucursal->numero) ? $sucursal->numero : '' }}" placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero" name="numero" maxlength="5"/>
        <small class="small" id="small-numero"></small>

        <br />
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
            <option value="">Seleccione una provincia</option>
                @forelse($provincias as $provincia)
                    @if (isset($sucursal->localidad->provincia) && $sucursal->localidad->provincia->nombre_provincia==$provincia->nombre_provincia)
                        <option selected value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
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

        @if(isset($sucursal->telefonos))
            @forelse($sucursal->telefonos as $telefono)
                <div class="row">
                    <div class="col-sm">
                        <label for="telefono_sucursal_cod">Código de área:</label><br>
                        <input  @if ( $mode == "show") readonly @endif  id="telefono_sucursal_cod" name="telefono_sucursal_cod" type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ej: 2966" aria-describedby="basic-addon1" maxlength="4" value="{{ isset($telefono->cod_area_tel) ? $telefono->cod_area_tel : '' }}">
                        <small class="small" id="small-telefono_sucursal_cod"></small>

                    </div>
                    <div class="col-sm">
                        <label for="telefono_sucursal">Número de Teléfono:</label><br>
                        <input @if ( $mode == "show") readonly @endif id="telefono_sucursal" name="telefono_sucursal" type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Teléfono" aria-describedby="basic-addon1" maxlength="14" value="{{ isset($telefono->nro_tel) ? $telefono->nro_tel : '' }}">
                        <small class="small" id="small-telefono_sucursal"></small>

                    </div>
                </div>
            @empty
                <div class="row">
                    <div class="col-sm">
                        <label for="telefono_sucursal_cod">Código de área:</label><br>
                        <input @if ( $mode == "show") readonly @endif id="telefono_sucursal_cod" name="telefono_sucursal_cod" type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ej: 2966" aria-describedby="basic-addon1" maxlength="4" value="{{ isset($telefono->cod_area_tel) ? $telefono->cod_area_tel : '' }}">
                        <small class="small" id="small-telefono_sucursal_cod"></small>

                    </div>
                    <div class="col-sm">
                        <label for="telefono_sucursal">Número de Teléfono:</label><br>
                        <input  @if ( $mode == "show") readonly @endif  id="telefono_sucursal" name="telefono_sucursal" type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Teléfono" aria-describedby="basic-addon1" maxlength="14" value="{{ isset($telefono->nro_tel) ? $telefono->nro_tel : '' }}">
                        <small class="small" id="small-telefono_sucursal"></small>

                    </div>
                </div>
            @endforelse
        @else
            <div class="row">
                <div class="col-sm">
                    <label for="telefono_sucursal_cod">Código de área:</label><br>
                    <input  @if ( $mode == "show") readonly @endif type="text" id="telefono_sucursal_cod" name="telefono_sucursal_cod" onkeypress="return valideKey(event);" class="form-control" placeholder="Ej: 2966" aria-describedby="basic-addon1" maxlength="4" value="{{ isset($telefono->cod_area_tel) ? $telefono->cod_area_tel : '' }}">
                    <small class="small" id="small-telefono_sucursal_cod"></small>

                </div>
                <div class="col-sm">
                    <label for="telefono_sucursal">Número de Teléfono:</label><br>
                    <input  @if ( $mode == "show") readonly @endif type="text"  id="telefono_sucursal" name="telefono_sucursal"  onkeypress="return valideKey(event);" class="form-control" placeholder="Teléfono" aria-describedby="basic-addon1" maxlength="14" value="{{ isset($telefono->nro_tel) ? $telefono->nro_tel : '' }}">
                    <small class="small" id="small-telefono_sucursal"></small>

                </div>
            </div>

        @endif
        <br>
        <input type="hidden" id="editar_sucursal">

        <input type="hidden" id="id_sucursal" value={{isset($sucursal) ? $sucursal->id_sucursal : '' }}>
    </div>
</div>
@push("js")
<script>

$('#telefono_sucursal_cod').keyup(validarTelefonoSucursalCod);

    function validarTelefonoSucursalCod() {

        if (!(/^[0-9]+$/.test($('#telefono_sucursal_cod').val()))) {
            if($('#telefono_sucursal_cod').val() != ""){

            mostrarError('#telefono_sucursal_cod', '#small-telefono_sucursal_cod', '<div class="alert alert-danger mt-3 pt-1">El <strong>código de área</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
            }
        }
        ocultarError('#telefono_sucursal_cod', '#small-telefono_sucursal_cod');
        return true;
    }



    $('#telefono_sucursal').keyup(validarTelefonoSucursal);

    function validarTelefonoSucursal() {

        if (!(/^[0-9]+$/.test($('#telefono_sucursal').val()))) {
            if($('#telefono_sucursal').val() != ""){

            mostrarError('#telefono_sucursal', '#small-telefono_sucursal', '<div class="alert alert-danger mt-3 pt-1">El <strong>teléfono</strong> debe contener solamente dígitos numéricos.</div>');
            return false;
            }
        }
        ocultarError('#telefono_sucursal', '#small-telefono_sucursal');
        return true;
    }


$('#lote').keyup(validarLote);

function validarLote() {

    if (!(/^[0-9]+$/.test($('#lote').val()))) {

        if($('#lote').val() != ""){

        mostrarError('#lote', '#small-lote', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de LOTE</strong> debe contener solamente dígitos numéricos.</div>');
        return false;
    }
    }
    ocultarError('#lote', '#small-lote');
    return true;
}

$('#numero').keyup(validarNumero);

function validarNumero() {

    if (!(/^[0-9]+$/.test($('#numero').val()))) {
        if($('#telefono_sucursal').val() != ""){

        mostrarError('#numero', '#small-numero', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de NUMERO</strong> debe contener solamente dígitos numéricos.</div>');
        return false;
        }
    }
    ocultarError('#numero', '#small-numero');
    return true;
}





</script>
@endpush
