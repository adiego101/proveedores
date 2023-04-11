<fieldset>
    <div class="d-flex">
        <div class="mr-auto p-2">
            <h1>Datos del domicilio {{$tipo_domicilio}}</h1>
        </div>        
        @if($tipo_domicilio!='real' && $mode!='show')
            <div class="p-2">
                <a href="javascript:void(0);" id="copy_{{$tipo_domicilio}}" title="Traer datos Domicilio Real"><input type="button" value="Traer datos Domicilio Real" class="btn btn-outline-secondary btn-sm"></a>
            </div>
        @endif
    </div>
    @if($mode=='edit')
        <small class="small" id="small-domicilio-{{$tipo_domicilio}}-head"></small>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <label for="calle_{{$tipo_domicilio}}_{{$mode}}">Calle:</label><br>
                <input type="text" class="form-control" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="Ingrese la calle" aria-describedby="basic-addon1" id="calle_{{$tipo_domicilio}}_{{$mode}}" name="calle_{{$tipo_domicilio}}" maxlength="50"
                    value=  @if($tipo_domicilio=='real')"{{isset($proveedor->domicilio_real) ? $proveedor->domicilio_real->calle : '' }}"@endif
                            @if($tipo_domicilio=='legal')"{{isset($proveedor->domicilio_legal) ? $proveedor->domicilio_legal->calle : '' }}"@endif
                            @if($tipo_domicilio=='fiscal')"{{isset($proveedor->domicilio_fiscal) ? $proveedor->domicilio_fiscal->calle : '' }}"@endif
                            @if($tipo_domicilio=='sucursal')"{{isset($sucursal->calle) ? $sucursal->calle : '' }}"@endif><br>
                <label for="dpto_{{$tipo_domicilio}}_{{$mode}}">Departamento:</label><br>
                <input type="text" class="form-control" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="Ingrese el departamento" aria-describedby="basic-addon1" id="dpto_{{$tipo_domicilio}}_{{$mode}}" name="dpto_{{$tipo_domicilio}}" maxlength="10"
                    value=  @if($tipo_domicilio=='real')"{{isset($proveedor->domicilio_real) ? $proveedor->domicilio_real->dpto : '' }}"@endif
                            @if($tipo_domicilio=='legal')"{{isset($proveedor->domicilio_legal) ? $proveedor->domicilio_legal->dpto : '' }}"@endif
                            @if($tipo_domicilio=='fiscal')"{{isset($proveedor->domicilio_fiscal) ? $proveedor->domicilio_fiscal->dpto : '' }}"@endif
                            @if($tipo_domicilio=='sucursal')"{{isset($sucursal->dpto) ? $sucursal->dpto : '' }}"@endif><br>

                <label for="lote_{{$tipo_domicilio}}_{{$mode}}">Lote:</label><br>
                <input type="text"  onkeypress="return valideKey(event);" class="form-control" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="Ingrese el número de lote" aria-describedby="basic-addon1" id="lote_{{$tipo_domicilio}}_{{$mode}}" name="lote_{{$tipo_domicilio}}" maxlength="4"
                    value=  @if($tipo_domicilio=='real')"{{isset($proveedor->domicilio_real) ? $proveedor->domicilio_real->lote : '' }}"@endif
                            @if($tipo_domicilio=='legal')"{{isset($proveedor->domicilio_legal) ? $proveedor->domicilio_legal->lote : '' }}"@endif
                            @if($tipo_domicilio=='fiscal')"{{isset($proveedor->domicilio_fiscal) ? $proveedor->domicilio_fiscal->lote : '' }}"@endif
                            @if($tipo_domicilio=='sucursal')"{{isset($sucursal->lote) ? $sucursal->lote : '' }}"@endif>
                <small class="small" id="small-lote-{{$tipo_domicilio}}-{{$mode}}"></small>
                <br>

                <label for="entreCalles_{{$tipo_domicilio}}_{{$mode}}">Entre Calles:</label><br>
                <input type="text" class="form-control" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="Ingrese las calles correspondientes" aria-describedby="basic-addon1" id="entreCalles_{{$tipo_domicilio}}_{{$mode}}" name="entreCalles_{{$tipo_domicilio}}" maxlength="70"
                    value=  @if($tipo_domicilio=='real')"{{isset($proveedor->domicilio_real) ? $proveedor->domicilio_real->entre_calles : '' }}"@endif
                            @if($tipo_domicilio=='legal')"{{isset($proveedor->domicilio_legal) ? $proveedor->domicilio_legal->entre_calles : '' }}"@endif
                            @if($tipo_domicilio=='fiscal')"{{isset($proveedor->domicilio_fiscal) ? $proveedor->domicilio_fiscal->entre_calles : '' }}"@endif
                            @if($tipo_domicilio=='sucursal')"{{isset($sucursal->entre_calles) ? $sucursal->entre_calles : '' }}"@endif><br>

                <label for="monoblock_{{$tipo_domicilio}}_{{$mode}}">Monoblock:</label><br>
                <input type="text" class="form-control" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="Ingrese el monoblock" aria-describedby="basic-addon1" id="monoblock_{{$tipo_domicilio}}_{{$mode}}" name="monoblock_{{$tipo_domicilio}}" maxlength="10"
                    value=  @if($tipo_domicilio=='real')"{{isset($proveedor->domicilio_real) ? $proveedor->domicilio_real->monoblock : '' }}"@endif
                            @if($tipo_domicilio=='legal')"{{isset($proveedor->domicilio_legal) ? $proveedor->domicilio_legal->monoblock : '' }}"@endif
                            @if($tipo_domicilio=='fiscal')"{{isset($proveedor->domicilio_fiscal) ? $proveedor->domicilio_fiscal->monoblock : '' }}"@endif
                            @if($tipo_domicilio=='sucursal')"{{isset($sucursal) ? $sucursal->monoblock : '' }}"@endif><br>

                <label for="pais_{{$tipo_domicilio}}_{{$mode}}">País:</label><br>
                <select class="form-control" @if ( $mode == "show" || $mode=='modal-show') disabled @endif aria-describedby="basic-addon1" id="pais_{{$tipo_domicilio}}_{{$mode}}" name="pais_{{$tipo_domicilio}}">
                    @forelse($paises as $pais)
                        <option selected value="{{$pais->nombre_pais}}">{{$pais->nombre_pais}}</option>
                    @empty
                        <option value=" ">Seleccione un país</option>
                    @endforelse
                </select>
                <br>

                <label for="localidad_{{$tipo_domicilio}}_{{$mode}}">Localidad:</label><br>
                <select class="js-example-basic-single" @if ( $mode == "show" || $mode=='modal-show') disabled @endif aria-describedby="basic-addon1" id="localidad_{{$tipo_domicilio}}_{{$mode}}" name="localidad_{{$tipo_domicilio}}">
                    <option value= @if($tipo_domicilio=='real')"{{isset($proveedor->domicilio_real->localidad) ? $proveedor->domicilio_real->localidad->id_localidad : '' }}"@endif
                                    @if($tipo_domicilio=='legal')"{{isset($proveedor->domicilio_legal->localidad) ? $proveedor->domicilio_legal->localidad->id_localidad : '' }}"@endif
                                    @if($tipo_domicilio=='fiscal')"{{isset($proveedor->domicilio_fiscal->localidad) ? $proveedor->domicilio_fiscal->localidad->id_localidad : '' }}"@endif
                                    @if($tipo_domicilio=='sucursal')"{{isset($sucursal->localidad) ? $sucursal->localidad->id_localidad : '' }}"@endif>
                    @if($tipo_domicilio=='real'){{isset($proveedor->domicilio_real->localidad) ? $proveedor->domicilio_real->localidad->nombre_localidad : 'Seleccione una localidad' }}@endif
                    @if($tipo_domicilio=='legal'){{isset($proveedor->domicilio_legal->localidad) ? $proveedor->domicilio_legal->localidad->nombre_localidad : 'Seleccione una localidad' }}@endif
                    @if($tipo_domicilio=='fiscal'){{isset($proveedor->domicilio_fiscal->localidad) ? $proveedor->domicilio_fiscal->localidad->nombre_localidad : 'Seleccione una localidad' }}@endif
                    @if($tipo_domicilio=='sucursal'){{isset($sucursal->localidad) ? $sucursal->localidad->nombre_localidad : 'Seleccione una localidad' }}@endif
                </option>
                </select>
                <br>

                @if($tipo_domicilio=='real')
                    <label for="pagina_web">Página web:</label><br>
                    <input type="text" class="form-control" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="Ingrese la página web"
                        aria-describedby="basic-addon1" id="pagina_web" name="pagina_web" maxlength="50"
                        value="{{ isset($proveedor->pagina_web) ? $proveedor->pagina_web : '' }}"><br>
                @endif
                <div class="field_email_{{$tipo_domicilio}}_{{$mode}}">
                    @php $emails=[];@endphp
                    @if(isset($proveedor))
                        @switch($tipo_domicilio)
                            @case('real')
                                @php $emails=$proveedor->emails_real;@endphp
                            @break
                            @case('legal')
                                @php $emails=$proveedor->emails_legal;@endphp
                            @break
                            @case('fiscal')
                                @php $emails=$proveedor->emails_fiscal;@endphp
                            @break
                            @case('sucursal')
                                @if(isset($sucursal))
                                    @php $emails=$sucursal->emails;@endphp
                                @endif
                            @break
                        @endswitch
                    @endif
                    @forelse($emails as $email)
                        @if (!$loop->first)
                            <div>
                                <br>
                                <label>Correo electrónico:</label><br>
                                <input type="email" class="form-control emails_{{$tipo_domicilio}}_{{$mode}}" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" name="email_{{$tipo_domicilio}}[]" @if ( $mode == "show") readonly @endif value="{{$email->email}}" maxlength="50">
                                @if($mode=='edit')<a href="javascript:void(0);" class="remove_email_{{$tipo_domicilio}}_{{$mode}}" title="Elimine el correo"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>@endif
                            </div>
                        @else
                            <label for="email_{{$tipo_domicilio}}_{{$mode}}">Correo electrónico:</label><br>
                            <input type="email" class="form-control emails_{{$tipo_domicilio}}_{{$mode}}" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email_{{$tipo_domicilio}}_{{$mode}}" name="email_{{$tipo_domicilio}}[]" @if ( $mode == "show") readonly @endif value="{{$email->email}}" maxlength="50">
                        @endif
                    @empty
                        <label for="email_{{$tipo_domicilio}}_{{$mode}}">Correo electrónico:</label><br>
                        <input type="email" class="form-control emails_{{$tipo_domicilio}}_{{$mode}}" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email_{{$tipo_domicilio}}_{{$mode}}" name="email_{{$tipo_domicilio}}[]" maxlength="50">
                    @endforelse
                </div>
                <br>
                @if ( $mode != "show" && count($emails) < 3)
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="javascript:void(0);" class="add_email_{{$tipo_domicilio}}_{{$mode}}" title="Agregue un nuevo correo"><input type="button" @if ( $mode == "show") readonly @endif value="Agregar nuevo correo" class="btn btn-outline-success"></a>
                    </div>
                @else
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="javascript:void(0);" class="add_email_{{$tipo_domicilio}}_{{$mode}}" title="Agregue un nuevo correo" style="display:none;"><input type="button" @if ( $mode == "show") readonly @endif value="Agregar nuevo correo" class="btn btn-outline-success"></a>
                    </div>
                @endif

               <!-- <label for="telefono_real">Teléfono:</label><br>
                <input type="text" onkeypress="return valideKey(event);" class="form-control" placeholder="Ingrese el número de teléfono" aria-describedby="basic-addon1" id="telefono_real" name="telefono_real[]" maxlength="14"> -->
            </div>
            <div class="col-sm">

                <label for="numero_{{$tipo_domicilio}}_{{$mode}}">Número:</label><br>
                <input type="text"  onkeypress="return valideKey(event);" class="form-control" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="Ingrese el número de la calle" aria-describedby="basic-addon1" id="numero_{{$tipo_domicilio}}_{{$mode}}" name="numero_{{$tipo_domicilio}}" maxlength="5"
                    value=  @if($tipo_domicilio=='real')"{{isset($proveedor->domicilio_real) ? $proveedor->domicilio_real->numero : '' }}"@endif
                            @if($tipo_domicilio=='legal')"{{isset($proveedor->domicilio_legal) ? $proveedor->domicilio_legal->numero : '' }}"@endif
                            @if($tipo_domicilio=='fiscal')"{{isset($proveedor->domicilio_fiscal) ? $proveedor->domicilio_fiscal->numero : '' }}"@endif
                            @if($tipo_domicilio=='sucursal')"{{isset($sucursal->numero) ? $sucursal->numero : '' }}"@endif>
                <small class="small" id="small-numero-{{$tipo_domicilio}}-{{$mode}}"></small>
                <br>

                <label for="puerta_{{$tipo_domicilio}}_{{$mode}}">Puerta:</label><br>
                <input type="text" class="form-control" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="Ingrese la puerta" aria-describedby="basic-addon1" id="puerta_{{$tipo_domicilio}}_{{$mode}}" name="puerta_{{$tipo_domicilio}}" maxlength="4"
                    value=  @if($tipo_domicilio=='real')"{{isset($proveedor->domicilio_real) ? $proveedor->domicilio_real->puerta : '' }}"@endif
                            @if($tipo_domicilio=='legal')"{{isset($proveedor->domicilio_legal) ? $proveedor->domicilio_legal->puerta : '' }}"@endif
                            @if($tipo_domicilio=='fiscal')"{{isset($proveedor->domicilio_fiscal) ? $proveedor->domicilio_fiscal->puerta : '' }}"@endif
                            @if($tipo_domicilio=='sucursal')"{{isset($sucursal->puerta) ? $sucursal->puerta : '' }}"@endif><br>

                <label for="manzana_{{$tipo_domicilio}}_{{$mode}}">Manzana:</label><br>
                <input type="text" class="form-control" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="Ingrese el número de manzana" aria-describedby="basic-addon1" id="manzana_{{$tipo_domicilio}}_{{$mode}}" name="manzana_{{$tipo_domicilio}}" maxlength="5"
                    value=  @if($tipo_domicilio=='real')"{{isset($proveedor->domicilio_real) ? $proveedor->domicilio_real->manzana : '' }}"@endif
                            @if($tipo_domicilio=='legal')"{{isset($proveedor->domicilio_legal) ? $proveedor->domicilio_legal->manzana : '' }}"@endif
                            @if($tipo_domicilio=='fiscal')"{{isset($proveedor->domicilio_fiscal) ? $proveedor->domicilio_fiscal->manzana : '' }}"@endif
                            @if($tipo_domicilio=='sucursal')"{{isset($sucursal->manzana) ? $sucursal->manzana : '' }}"@endif><br>

                <label for="oficina_{{$tipo_domicilio}}_{{$mode}}">Oficina:</label><br>
                <input type="text" class="form-control" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="Ingrese la oficina" aria-describedby="basic-addon1" id="oficina_{{$tipo_domicilio}}_{{$mode}}" name="oficina_{{$tipo_domicilio}}" maxlength="4"
                    value=  @if($tipo_domicilio=='real')"{{isset($proveedor->domicilio_real) ? $proveedor->domicilio_real->oficina : '' }}"@endif
                            @if($tipo_domicilio=='legal')"{{isset($proveedor->domicilio_legal) ? $proveedor->domicilio_legal->oficina : '' }}"@endif
                            @if($tipo_domicilio=='fiscal')"{{isset($proveedor->domicilio_fiscal) ? $proveedor->domicilio_fiscal->oficina : '' }}"@endif
                            @if($tipo_domicilio=='sucursal')"{{isset($sucursal->oficina) ? $sucursal->oficina : '' }}"@endif><br>

                <label for="barrio_{{$tipo_domicilio}}_{{$mode}}">Barrio:</label><br>
                <input type="text" class="form-control" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="Ingrese el barrio" aria-describedby="basic-addon1" id="barrio_{{$tipo_domicilio}}_{{$mode}}" name="barrio_{{$tipo_domicilio}}" maxlength="50"
                    value=  @if($tipo_domicilio=='real')"{{isset($proveedor->domicilio_real) ? $proveedor->domicilio_real->barrio : '' }}"@endif
                            @if($tipo_domicilio=='legal')"{{isset($proveedor->domicilio_legal) ? $proveedor->domicilio_legal->barrio : '' }}"@endif
                            @if($tipo_domicilio=='fiscal')"{{isset($proveedor->domicilio_fiscal) ? $proveedor->domicilio_fiscal->barrio : '' }}"@endif
                            @if($tipo_domicilio=='sucursal')"{{isset($sucursal->barrio) ? $sucursal->barrio : '' }}"@endif><br>

                <label for="provincia_{{$tipo_domicilio}}_{{$mode}}">Provincia:</label><br>
                <select class="js-example-basic-single" @if ( $mode == "show" || $mode=='modal-show') disabled @endif aria-describedby="basic-addon1" id="provincia_{{$tipo_domicilio}}_{{$mode}}" name="provincia_{{$tipo_domicilio}}">
                <!--<option value=  @if($tipo_domicilio=='real')"{{isset($proveedor->domicilio_real->localidad->provincia) ? $proveedor->domicilio_real->localidad->provincia->nombre_provincia : '' }}"@endif
                                @if($tipo_domicilio=='legal')"{{isset($proveedor->domicilio_legal->localidad->provincia) ? $proveedor->domicilio_legal->localidad->provincia->nombre_provincia : '' }}"@endif
                                @if($tipo_domicilio=='fiscal')"{{isset($proveedor->domicilio_fiscal->localidad->provincia) ? $proveedor->domicilio_fiscal->localidad->provincia->nombre_provincia : '' }}"@endif
                                @if($tipo_domicilio=='sucursal')"{{isset($sucursal->localidad->provincia) ? $sucursal->localidad->provincia->nombre_provincia : '' }}"@endif>
                    @if($tipo_domicilio=='real'){{isset($proveedor->domicilio_real->localidad->provincia) ? $proveedor->domicilio_real->localidad->provincia->nombre_provincia : 'Seleccione una provincia' }}@endif
                    @if($tipo_domicilio=='legal'){{isset($proveedor->domicilio_legal->localidad->provincia) ? $proveedor->domicilio_legal->localidad->provincia->nombre_provincia : 'Seleccione una provincia' }}@endif
                    @if($tipo_domicilio=='fiscal'){{isset($proveedor->domicilio_fiscal->localidad->provincia) ? $proveedor->domicilio_fiscal->localidad->provincia->nombre_provincia : 'Seleccione una provincia' }}@endif
                    @if($tipo_domicilio=='sucursal'){{isset($sucursal->localidad->provincia) ? $sucursal->localidad->provincia->nombre_provincia : 'Seleccione una provincia' }}@endif
                </option>-->
                    <option value="">Seleccione una provincia</option>
                    @forelse($provincias as $provincia)
                        @if($tipo_domicilio=='real')
                            <option value="{{$provincia->nombre_provincia}}" @if(isset($proveedor->domicilio_real->localidad->provincia) && $proveedor->domicilio_real->localidad->provincia->nombre_provincia==$provincia->nombre_provincia) selected @endif>{{$provincia->nombre_provincia}}</option>
                        @else
                            @if($tipo_domicilio=='legal')
                                <option value="{{$provincia->nombre_provincia}}" @if(isset($proveedor->domicilio_legal->localidad->provincia) && $proveedor->domicilio_legal->localidad->provincia->nombre_provincia==$provincia->nombre_provincia) selected @endif>{{$provincia->nombre_provincia}}</option>
                            @else
                                @if($tipo_domicilio=='fiscal')
                                    <option value="{{$provincia->nombre_provincia}}" @if(isset($proveedor->domicilio_fiscal->localidad->provincia) && $proveedor->domicilio_fiscal->localidad->provincia->nombre_provincia==$provincia->nombre_provincia) selected @endif>{{$provincia->nombre_provincia}}</option>
                                @else
                                    <option value="{{$provincia->nombre_provincia}}">{{$provincia->nombre_provincia}}</option>
                                @endif
                            @endif
                        @endif
                    @empty
                        <option value=" "></option>
                    @endforelse
                </select>
                <br>

                <label for="cp_{{$tipo_domicilio}}_{{$mode}}">Código Postal:</label><br>
                <input type="text" class="form-control" @if ( $mode == "show" || $mode=='modal-show') disabled @endif aria-describedby="basic-addon1" id="cp_{{$tipo_domicilio}}_{{$mode}}" name="cp_{{$tipo_domicilio}}" placeholder="Ingrese el código postal" maxlength="8"
                    value=  @if($tipo_domicilio=='real')"{{isset($proveedor->domicilio_real) ? $proveedor->domicilio_real->codigo_postal : '' }}"@endif
                            @if($tipo_domicilio=='legal')"{{isset($proveedor->domicilio_legal) ? $proveedor->domicilio_legal->codigo_postal : '' }}"@endif
                            @if($tipo_domicilio=='fiscal')"{{isset($proveedor->domicilio_fiscal) ? $proveedor->domicilio_fiscal->codigo_postal : '' }}"@endif
                            @if($tipo_domicilio=='sucursal')"{{isset($sucursal->codigo_postal) ? $sucursal->codigo_postal : '' }}"@endif><br>

                @if($tipo_domicilio =='real')
                <br>
                <br>
                <br>
                <br>
                @endif
                <div class="field_telefono_{{$tipo_domicilio}}_{{$mode}}">
                    @php $telefonos=[];@endphp
                    @if(isset($proveedor))
                        @switch($tipo_domicilio)
                            @case('real')
                                @php $telefonos=$proveedor->telefonos_real;@endphp
                            @break
                            @case('legal')
                                @php $telefonos=$proveedor->telefonos_legal;@endphp
                            @break
                            @case('fiscal')
                                @php $telefonos=$proveedor->telefonos_fiscal;@endphp
                            @break
                            @case('sucursal')
                                @if(isset($sucursal))
                                    @php $telefonos=$sucursal->telefonos;@endphp
                                @endif
                            @break
                        @endswitch
                    @endif

                    @forelse($telefonos as $telefono)
                        <div>
                            @if (!$loop->first)
                                <div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm">
                                            <label>Código de área:</label><br>
                                            <input type="text" onkeypress="return valideKey(event);" class="form-control codigos_telefono_{{$tipo_domicilio}}_{{$mode}}" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="Ej: 2966" aria-describedby="basic-addon1" name="telefono_{{$tipo_domicilio}}_cod[]" @if ( $mode == "show") readonly @endif value="{{$telefono->cod_area_tel}}" maxlength="4">
                                            <small class="small" id="small-telefono-{{$tipo_domicilio}}-cod-{{$mode}}"></small>
                                        </div>
                                        <div class="col-sm">
                                            <label> Número de Teléfono:</label><br>
                                            <input type="text" onkeypress="return valideKey(event);" class="form-control nros_telefono_{{$tipo_domicilio}}_{{$mode}}" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="Teléfono" aria-describedby="basic-addon1" name="telefono_{{$tipo_domicilio}}[]" @if ( $mode == "show") readonly @endif value="{{$telefono->nro_tel}}" maxlength="14">
                                            <small class="small" id="small-telefono-{{$tipo_domicilio}}-{{$mode}}"></small>
                                        </div>
                                    </div>
                                    @if($mode=='edit')<a href="javascript:void(0);" class="remove_telefono_{{$tipo_domicilio}}_{{$mode}}" title="Elimine el teléfono"><input type="button" value="Eliminar" class="btn btn-danger btn-xs"></a>@endif
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-sm">
                                        <label for="telefono_{{$tipo_domicilio}}_cod_{{$mode}}">Código de área:</label><br>
                                        <input type="text" onkeypress="return valideKey(event);" class="form-control codigos_telefono_{{$tipo_domicilio}}_{{$mode}}" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="Ej: 2966" aria-describedby="basic-addon1" id="telefono_{{$tipo_domicilio}}_cod_{{$mode}}" name="telefono_{{$tipo_domicilio}}_cod[]" @if ( $mode == "show") readonly @endif value="{{$telefono->cod_area_tel}}" maxlength="4">
                                        <small class="small" id="small-telefono-{{$tipo_domicilio}}-cod-{{$mode}}"></small>
                                    </div>
                                    <div class="col-sm">
                                        <label for="telefono_{{$tipo_domicilio}}_{{$mode}}">Número de Teléfono:</label><br>
                                        <input type="text" onkeypress="return valideKey(event);" class="form-control nros_telefono_{{$tipo_domicilio}}_{{$mode}}" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="Teléfono" aria-describedby="basic-addon1" id="telefono_{{$tipo_domicilio}}_{{$mode}}" name="telefono_{{$tipo_domicilio}}[]" @if ( $mode == "show") readonly @endif value="{{$telefono->nro_tel}}" maxlength="14">
                                        <small class="small" id="small-telefono-{{$tipo_domicilio}}-{{$mode}}"></small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="row">
                            <div class="col-sm">
                                <label for="telefono_{{$tipo_domicilio}}_cod_{{$mode}}">Código de área:</label><br>
                                <input type="text" onkeypress="return valideKey(event);" class="form-control codigos_telefono_{{$tipo_domicilio}}_{{$mode}}" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="Ej: 2966" aria-describedby="basic-addon1" id="telefono_{{$tipo_domicilio}}_cod_{{$mode}}" name="telefono_{{$tipo_domicilio}}_cod[]" maxlength="4">
                                <small class="small" id="small-telefono-{{$tipo_domicilio}}-cod-{{$mode}}"></small>
                            </div>
                            <div class="col-sm">
                                <label for="telefono_{{$tipo_domicilio}}_{{$mode}}">Número de Teléfono:</label><br>
                                <input type="text" onkeypress="return valideKey(event);" class="form-control nros_telefono_{{$tipo_domicilio}}_{{$mode}}" @if ( $mode == "show" || $mode=='modal-show') disabled @endif placeholder="Teléfono" aria-describedby="basic-addon1" id="telefono_{{$tipo_domicilio}}_{{$mode}}" name="telefono_{{$tipo_domicilio}}[]" maxlength="14">
                                <small class="small" id="small-telefono-{{$tipo_domicilio}}-{{$mode}}"></small>
                            </div>
                        </div>
                    @endforelse
                </div>
                <br>
                @if ( $mode != "show" && count($telefonos) < 3 )
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="javascript:void(0);" class="add_telefono_{{$tipo_domicilio}}_{{$mode}}" title="Agregue un nuevo teléfono"><input type="button" @if ( $mode == "show" || $mode=='modal-show') readonly @endif value="Agregar nuevo teléfono" class="btn btn-outline-success"></a>
                    </div>
                @else
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="javascript:void(0);" class="add_telefono_{{$tipo_domicilio}}_{{$mode}}" title="Agregue un nuevo teléfono" style="display:none;"><input type="button" @if ( $mode == "show" || $mode=='modal-show') readonly @endif value="Agregar nuevo teléfono" class="btn btn-outline-success"></a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <br>
    @if($mode=='create')
        <input type="button" name="previous" class="previous btn btn btn-outline-secondary" value="Atrás" />
        <input type="button" name="next" class="next btn btn-info" data-tipo-domicilio="{{$tipo_domicilio}}" value="Siguiente" />
    @else
        <div class="row navbuttons">
            <div class="col-6 col-sm-auto">
                <input type="button" name="previous" class="previous btn btn-outline-secondary btnPrevious" data-tipo-domicilio="{{$tipo_domicilio}}" value="Atrás" />
            </div>
            <div class="col-6 col-sm-auto">
                <input type="button" class="btnNext btn btn-info" data-tipo-domicilio="{{$tipo_domicilio}}" value="Siguiente" />
            </div>
        </div>
    @endif
@push('js')

    <script type="text/javascript">

        $('#lote_{{$tipo_domicilio}}_{{$mode}}').keyup(validarLote);

        function validarLote() {

            if (!(/^[0-9]+$/.test($('#lote_{{$tipo_domicilio}}_{{$mode}}').val()))) {
                if($('#lote_{{$tipo_domicilio}}_{{$mode}}').val() != ""){

                mostrarError('#lote_{{$tipo_domicilio}}_{{$mode}}', '#small-lote-{{$tipo_domicilio}}-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El <strong>lote</strong> debe contener solamente dígitos numéricos.</div>');
                return false;
                }
            }
            ocultarError('#lote_{{$tipo_domicilio}}_{{$mode}}', '#small-lote-{{$tipo_domicilio}}-{{$mode}}');
            return true;
        }


        $('#numero_{{$tipo_domicilio}}_{{$mode}}').keyup(validarNumero);

        function validarNumero() {

            if (!(/^[0-9]+$/.test($('#numero_{{$tipo_domicilio}}_{{$mode}}').val()))) {
                if($('#numero_{{$tipo_domicilio}}_{{$mode}}').val() != ""){

                mostrarError('#numero_{{$tipo_domicilio}}_{{$mode}}', '#small-numero-{{$tipo_domicilio}}-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El <strong>número de la calle</strong> debe contener solamente dígitos numéricos.</div>');
                return false;
                }
            }
            ocultarError('#numero_{{$tipo_domicilio}}_{{$mode}}', '#small-numero-{{$tipo_domicilio}}-{{$mode}}');
            return true;
        }


        $('#telefono_{{$tipo_domicilio}}_cod_{{$mode}}').keyup(validarTelefonoCod);

        function validarTelefonoCod() {

            if (!(/^[0-9]+$/.test($('#telefono_{{$tipo_domicilio}}_cod_{{$mode}}').val()))) {
                if($('#telefono_{{$tipo_domicilio}}_cod_{{$mode}}').val() != ""){

                mostrarError('#telefono_{{$tipo_domicilio}}_cod_{{$mode}}', '#small-telefono-{{$tipo_domicilio}}-cod-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El <strong>código de área</strong> debe contener solamente dígitos numéricos.</div>');
                return false;
                }
            }
            ocultarError('#telefono_{{$tipo_domicilio}}_cod_{{$mode}}', '#small-telefono-{{$tipo_domicilio}}-cod-{{$mode}}');
            return true;
        }



        $('#telefono_{{$tipo_domicilio}}_{{$mode}}').keyup(validarTelefono);

        function validarTelefono() {

            if (!(/^[0-9]+$/.test($('#telefono_{{$tipo_domicilio}}_{{$mode}}').val()))) {
                if($('#telefono_{{$tipo_domicilio}}_{{$mode}}').val() != ""){

                mostrarError('#telefono_{{$tipo_domicilio}}_{{$mode}}', '#small-telefono-{{$tipo_domicilio}}-{{$mode}}', '<div class="alert alert-danger mt-3 pt-1">El <strong>teléfono</strong> debe contener solamente dígitos numéricos.</div>');
                return false;
                }
            }
            ocultarError('#telefono_{{$tipo_domicilio}}_{{$mode}}', '#small-telefono-{{$tipo_domicilio}}-{{$mode}}');
            return true;
        }

        $(document).ready(function(){
        if ($('#provincia_real_edit').val()!=''){
                recargarListaDomicilio($('#provincia_real_edit').val(), $("#localidad_real_edit"));
            }
            if ($('#provincia_legal_edit').val()!=''){
                recargarListaDomicilio($('#provincia_legal_edit').val(), $('#localidad_legal_edit'));
            }
            if ($('#provincia_fiscal_edit').val()!=''){
                recargarListaDomicilio($('#provincia_fiscal_edit').val(), $('#localidad_fiscal_edit'));
            }
            @if($mode!="create")

            function recargarListaDomicilio(provincia_selected, select_localidad){

                console.log("{{url('localidadSelect/')}}/"+@if($tipo_domicilio=='real')"{{isset($proveedor->domicilio_real->localidad) ? $proveedor->domicilio_real->localidad->id_localidad : '' }}",@endif
                        @if($tipo_domicilio=='legal')"{{isset($proveedor->domicilio_legal->localidad) ? $proveedor->domicilio_legal->localidad->id_localidad : '' }}",@endif
                        @if($tipo_domicilio=='fiscal')"{{isset($proveedor->domicilio_fiscal->localidad) ? $proveedor->domicilio_fiscal->localidad->id_localidad : '' }}",@endif
                        @if($tipo_domicilio=='sucursal')"{{isset($sucursal->localidad) ? $sucursal->localidad->id_localidad : '' }}",@endif);
                    $.ajax({
                        type:"GET",
                        url:"{{url('localidadSelect/')}}/"+@if($tipo_domicilio=='real')"{{isset($proveedor->domicilio_real->localidad) ? $proveedor->domicilio_real->localidad->id_localidad : '' }}",@endif
                        @if($tipo_domicilio=='legal')"{{isset($proveedor->domicilio_legal->localidad) ? $proveedor->domicilio_legal->localidad->id_localidad : '' }}",@endif
                        @if($tipo_domicilio=='fiscal')"{{isset($proveedor->domicilio_fiscal->localidad) ? $proveedor->domicilio_fiscal->localidad->id_localidad : '' }}",@endif
                        @if($tipo_domicilio=='sucursal')"{{isset($sucursal->localidad) ? $sucursal->localidad->id_localidad : '' }}",@endif

                        success:function(r){
                            select_localidad.html(r);
                        }
                    });
                };
            @else
            function recargarListaDomicilio(provincia_selected, select_localidad){
                $.ajax({
                    type:"GET",
                    url:"{{url('localidades')}}/"+provincia_selected,
                    success:function(r){
                        select_localidad.html(r);
                    }
                });
            }
            @endif






            var maxField = 3; //Cantidad maxima de campos (emails y telefonos) a agregar
            var addTelefono = $('.add_telefono_{{$tipo_domicilio}}_{{$mode}}');
            var wrapper_telefono = $('.field_telefono_{{$tipo_domicilio}}_{{$mode}}');

            $(document).on('click','.add_telefono_{{$tipo_domicilio}}_{{$mode}}',function() {
                console.log("evento click en add telefono");
                var x = $('.field_telefono_{{$tipo_domicilio}}_{{$mode}} .row').length;
                console.log("cantidad de telefonos ya ingresados="+x);
                var fieldHTML_telefono='';
                if(x == 1){
                    //Nuevo campo html (agregar un nuevo teléfono)
                    fieldHTML_telefono= '<div>'+
                                            '<br><div class="row">'+
                                                '<div class="col-sm">'+
                                                    '<label>Código de área:</label><br>'+
                                                    '<input type="text" onkeypress="return valideKey(event);" class="form-control codigos_telefono_{{$tipo_domicilio}}_{{$mode}}" placeholder="Ej: 2966" aria-describedby="basic-addon1" name="telefono_{{$tipo_domicilio}}_cod[]" maxlength="4" value="">'+
                                                '</div>'+
                                                '<div class="col-sm">'+
                                                    '<label>Número de Teléfono:</label><br>'+
                                                    '<input type="text" onkeypress="return valideKey(event);" class="form-control nros_telefono_{{$tipo_domicilio}}_{{$mode}}" placeholder="Teléfono" aria-describedby="basic-addon1" name="telefono_{{$tipo_domicilio}}[]" maxlength="14" value="">'+
                                                '</div>'+
                                            '</div>'+
                                            '<a href="javascript:void(0);" class="remove_telefono_{{$tipo_domicilio}}_{{$mode}}" title="Elimine el teléfono"><input type="button" @if ( $mode == "show") readonly @endif value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                        '</div>';
                    //Obtenemos el valor del campo, al clickear el botón Agregar Teléfono
                    let tel = $('#telefono_{{$tipo_domicilio}}_{{$mode}}').val();
                    var cod_tel = $('#telefono_{{$tipo_domicilio}}_cod_{{$mode}}').val();

                    //Si el campo teléfono no se encuentra vacío, permite agregar un segundo campo.
                    if (tel != '' && cod_tel != '')
                        //Verifica el numero maximo de campos a agregar, con el limite establecido
                        if (x < maxField)
                            $('.field_telefono_{{$tipo_domicilio}}_{{$mode}}').append(fieldHTML_telefono); // Agrega un nuevo campo html (telefono)
                } else{
                    console.log("entra por ak con x="+x+" y maxfield="+maxField);
                    //Nuevo campo html (agregar un nuevo teléfono)
                    fieldHTML_telefono= '<div>'+
                                            '<br>'+
                                            '<div class="row">'+
                                                '<div class="col-sm">'+
                                                    '<label>Código de área:</label><br>'+
                                                    '<input type="text" onkeypress="return valideKey(event);" class="form-control codigos_telefono_{{$tipo_domicilio}}_{{$mode}}" placeholder="Ej: 2966" aria-describedby="basic-addon1" name="telefono_{{$tipo_domicilio}}_cod[]" maxlength="4">'+
                                                '</div>'+
                                                '<div class="col-sm">'+
                                                    '<label>Número de Teléfono:</label><br>'+
                                                    '<input type="text" onkeypress="return valideKey(event);" class="form-control nros_telefono_{{$tipo_domicilio}}_{{$mode}}" placeholder="Teléfono" aria-describedby="basic-addon1" name="telefono_{{$tipo_domicilio}}[]" maxlength="14">'+
                                                '</div>'+
                                            '</div>'+
                                            '<a href="javascript:void(0);" class="remove_telefono_{{$tipo_domicilio}}_{{$mode}}" title="Elimine el teléfono"><input type="button" @if ( $mode == "show") readonly @endif value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                        '</div>';
                    console.log("valor de ultimo telefono = "+$('.nros_telefono_{{$tipo_domicilio}}_{{$mode}}:last').val());
                    if ($('.nros_telefono_{{$tipo_domicilio}}_{{$mode}}:last').val() != '' && $('.codigos_telefono_{{$tipo_domicilio}}_{{$mode}}:last').val() != '')
                        //Verifica el numero maximo de campos a agregar, con el limite establecido
                        if (x < maxField)
                        {
                            $('.field_telefono_{{$tipo_domicilio}}_{{$mode}}').append(fieldHTML_telefono); // Agrega un nuevo campo html (telefono)
                            x+=1;
                            if(x==maxField)
                                $('.add_telefono_{{$tipo_domicilio}}_{{$mode}}').hide();
                        }
                }
            });

            $('.field_telefono_{{$tipo_domicilio}}_{{$mode}}').on('click', '.remove_telefono_{{$tipo_domicilio}}_{{$mode}}', function(e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remueve un campo html (telefono)
                if($('.nros_telefono_{{$tipo_domicilio}}_{{$mode}}').length < maxField)
                {
                    $(".add_telefono_{{$tipo_domicilio}}_{{$mode}}").show();
                    /*let add_telefono = '<div class="d-grid gap-2 d-md-flex justify-content-md-center">'+
                                            '<a href="javascript:void(0);" class="add_telefono_{{$tipo_domicilio}}_{{$mode}}" title="Agregue un nuevo teléfono"><input type="button" value="Agregar nuevo teléfono" class="btn btn-outline-success"></a>'+
                                        '</div>';
                    $('.field_telefono_{{$tipo_domicilio}}_{{$mode}}').parent().append(add_telefono);*/
                }
            });



            var addEmail = $('.add_email_{{$tipo_domicilio}}_{{$mode}}');
            var wrapper_email = $('.field_email_{{$tipo_domicilio}}_{{$mode}}');

            $(document).on('click','.add_email_{{$tipo_domicilio}}_{{$mode}}',function() {
                i=$('.emails_{{$tipo_domicilio}}_{{$mode}}').length;
                //Nuevo campo html (agregar un nuevo correo)
                var fieldHTML_email='';

                if(i == 1){
                    fieldHTML_email =   '<div><br>'+
                                            '<label>Correo electrónico:</label><br>'+
                                            '<input type="email" class="form-control emails_{{$tipo_domicilio}}_{{$mode}}" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" name="email_{{$tipo_domicilio}}[]" maxlength="50" value="">'+
                                            '<a href="javascript:void(0);" class="remove_email_{{$tipo_domicilio}}_{{$mode}}" title="Elimine el correo"><input type="button" @if ( $mode == "show") readonly @endif value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                        '</div>';

                    //Si el campo email no se encuentra vacío, permite agregar un segundo campo.
                    if ($('.emails_{{$tipo_domicilio}}_{{$mode}}:last').val() != '')
                        //Verifica el numero maximo de campos a agregar, con el limite establecido
                        if (i < maxField)
                            $('.field_email_{{$tipo_domicilio}}_{{$mode}}').append(fieldHTML_email); // Agrega un nuevo campo html (correo)

                } else{
                    fieldHTML_email =   '<div><br>'+
                                                '<label>Correo electrónico:</label><br>'+
                                                '<input type="email" class="form-control emails_{{$tipo_domicilio}}_{{$mode}}" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" name="email_{{$tipo_domicilio}}[]" maxlength="50">'+
                                                '<a href="javascript:void(0);" class="remove_email_{{$tipo_domicilio}}_{{$mode}}" title="Elimine el correo"><input type="button" @if ( $mode == "show") readonly @endif value="Eliminar" class="btn btn-danger btn-xs"></a>'+
                                            '</div>';
                    //Si el campo dinamico x no se encuentra vacío, permite agregar un siguiente campo x+1.
                    if ($('.emails_{{$tipo_domicilio}}_{{$mode}}:last').val() != '')
                        //Verifica el numero maximo de campos a agregar, con el limite establecido
                        if (i < maxField)
                        {
                            $('.field_email_{{$tipo_domicilio}}_{{$mode}}').append(fieldHTML_email); // Agrega un nuevo campo html (correo)
                            i++;
                        }
                    if(i==maxField)
                        $('.add_email_{{$tipo_domicilio}}_{{$mode}}').hide();
                }

            });


            $('.field_email_{{$tipo_domicilio}}_{{$mode}}').on('click', '.remove_email_{{$tipo_domicilio}}_{{$mode}}', function(e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remueve un campo html (correo)
                if($('.emails_{{$tipo_domicilio}}_{{$mode}}').length < maxField)
                {
                    /*let add_email = '<div class="d-grid gap-2 d-md-flex justify-content-md-center">'+
                                        '<a href="javascript:void(0);" class="add_email_{{$tipo_domicilio}}_{{$mode}}" title="Agregue un nuevo email"><input type="button" value="Agregar nuevo email" class="btn btn-outline-success"></a>'+
                                    '</div>';
                    $('.field_email_{{$tipo_domicilio}}_{{$mode}}').parent().append(add_email);*/

                    $(".add_email_{{$tipo_domicilio}}_{{$mode}}").show();
                }
            });
            $('#provincia_{{$tipo_domicilio}}_{{$mode}}').change(function(){
                console.log("detecta change en provincia_tipo_domicilio_mode");
                if($('#provincia_{{$tipo_domicilio}}_{{$mode}}').val()!='')
                    recargarListaDomicilio($('#provincia_{{$tipo_domicilio}}_{{$mode}}').val(), $('#localidad_{{$tipo_domicilio}}_{{$mode}}'));
                else
                {
                    $("#localidad_{{$tipo_domicilio}}_{{$mode}}").empty();
                    $("#localidad_{{$tipo_domicilio}}_{{$mode}}").append($("<option>",{value:'', text:'Seleccione una localidad'}));
                }
            });

            //Carga de datos del domicilio real en los domicilios fiscal y legal

            $('#copy_{{$tipo_domicilio}}').click(function() {
                console.log("detecta evento click en copy_legal");
                let tipo_domicilio = @json($tipo_domicilio);
                //Obtenemos los valores de cada uno de los campos del domicilio real
                var calle_r = $('#calle_real_{{$mode}}').val();
                var dpto_r = $('#dpto_real_{{$mode}}').val();
                var lote_r = $('#lote_real_{{$mode}}').val();
                var entreCalles_r = $('#entreCalles_real_{{$mode}}').val();
                var monoblock_r = $('#monoblock_real_{{$mode}}').val();
                var pais_r = $('#pais_real_{{$mode}}').val();
                var email_r = $('#email_real_{{$mode}}').val();
                var numero_r = $('#numero_real_{{$mode}}').val();
                var puerta_r = $('#puerta_real_{{$mode}}').val();
                var manzana_r = $('#manzana_real_{{$mode}}').val();
                var oficina_r = $('#oficina_real_{{$mode}}').val();
                var barrio_r = $('#barrio_real_{{$mode}}').val();
                var provincia_r = $('#provincia_real_{{$mode}}').val();
                var localidad_r = $('localidad_real_{{$mode}}');
                var cp_r = $('#cp_real_{{$mode}}').val();
                var cod_tel_r = $('#telefono_real_cod_{{$mode}}').val();
                var tel_r = $('#telefono_real_{{$mode}}').val();

                //Enviamos los valores obtenidos anteriormente a los campos del domicilio legal
                $('#calle_{{$tipo_domicilio}}_{{$mode}}').val(calle_r);
                $('#dpto_{{$tipo_domicilio}}_{{$mode}}').val(dpto_r);
                $('#lote_{{$tipo_domicilio}}_{{$mode}}').val(lote_r);
                $('#entreCalles_{{$tipo_domicilio}}_{{$mode}}').val(entreCalles_r);
                $('#monoblock_{{$tipo_domicilio}}_{{$mode}}').val(monoblock_r);
                $('#pais_{{$tipo_domicilio}}_{{$mode}}').val(pais_r);
                $('#email_{{$tipo_domicilio}}_{{$mode}}').val(email_r);
                $('#numero_{{$tipo_domicilio}}_{{$mode}}').val(numero_r);
                $('#puerta_{{$tipo_domicilio}}_{{$mode}}').val(puerta_r);
                $('#manzana_{{$tipo_domicilio}}_{{$mode}}').val(manzana_r);
                $('#oficina_{{$tipo_domicilio}}_{{$mode}}').val(oficina_r);
                $('#barrio_{{$tipo_domicilio}}_{{$mode}}').val(barrio_r);
                $("#provincia_{{$tipo_domicilio}}_{{$mode}} option[value='"+provincia_r+"']").attr("selected", true);
                console.log("tipo domicilio = {{$tipo_domicilio}}");
                recargarListaCopiaDomicilio(provincia_r, $('#localidad_{{$tipo_domicilio}}_{{$mode}}'), "{{$tipo_domicilio}}");
                $('#cp_{{$tipo_domicilio}}_{{$mode}}').val(cp_r);
                $('#telefono_{{$tipo_domicilio}}_cod_{{$mode}}').val(cod_tel_r);
                $('#telefono_{{$tipo_domicilio}}_{{$mode}}').val(tel_r);
            });
        });
        function recargarListaCopiaDomicilio(provincia_selected, select_localidad, tipo_domicilio){
            let mode=@json($mode);
            $.ajax({
                type:"GET",
                url:"{{url('localidades')}}/"+provincia_selected,
                success:function(r){
                    select_localidad.html(r);
                }
            }).done(function(){
                if(mode=='create')
                {
                    if(tipo_domicilio == 'legal')
                        $("#localidad_legal_create option[value='"+$('#localidad_real_create').val()+"']").attr("selected", true);
                    else
                        $("#localidad_fiscal_create option[value='"+$('#localidad_real_create').val()+"']").attr("selected", true);
                }
                else
                {
                    if(tipo_domicilio == 'legal')
                        $("#localidad_legal_edit option[value='"+$('#localidad_real_edit').val()+"']").attr("selected", true);
                    else
                        $("#localidad_fiscal_edit option[value='"+$('#localidad_real_edit').val()+"']").attr("selected", true);
                }
            });
        }
    </script>
@endpush

</fieldset>
