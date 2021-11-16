<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Contenido del Modal-->
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Editar Sucursal</h1>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            <div class="modal-body">
            <div class="row">
    </div>

    <br />
    
<!-- SE DEBEN ELIMINAR LOS ATRIBUTOS NAME DE CADA CAMPO Y SOLO DEJARLOS EN EL APPEND JS, PORQUE SINO AL ENVIAR LOS DATOS A LA BD SE ALMACENA SIEMPRE UN VALOR NULO AL PRINCIPIO. -->

    <div class="row">
        <div class="col-sm">
            <label for="calle">Calle:</label><br />
            <input type="text" class="form-control" placeholder="Calle" aria-describedby="basic-addon1"
                id="ecalle" /><br />

            <label for="entre_calles">Entre Calle:</label><br />
            <input type="text" class="form-control" placeholder="Entre Calles" aria-describedby="basic-addon1"
                id="entre_calles" /><br />

            <label for="dpto">Departamento:</label><br />
            <input type="text" class="form-control" placeholder="Departamento" aria-describedby="basic-addon1"
                id="dpto" /><br />

            {{-- <label for="lote">Lote:</label><br />
            <input type="text" class="form-control" placeholder="Lote" aria-describedby="basic-addon1" id="lote" name="lotes[]" /><br /> --}}

            {{-- <label for="monoblock">Monoblock:</label><br />
            <input type="text" class="form-control" placeholder="Monoblock" aria-describedby="basic-addon1"
                id="monoblock" name="monoblocks[]" /><br />

            <label for="localidad">Localidad:</label><br />
            <input type="text" class="form-control" aria-describedby="basic-addon1" placeholder="Localidad"
                id="localidad" name="Localidades[]" /><br /> --}}
            
            <label for="email">Correo electrónico:</label><br />
            <input type="email" class="form-control" placeholder="ejemplo@dominio.com" aria-describedby="basic-addon1" id="email" name="correos_electronicos[]" /><br />
        </div>

        <div class="col-sm">

            <label for="numero">Numero:</label><br />
            <input type="number" class="form-control" placeholder="Numero" aria-describedby="basic-addon1"
                id="numero" /><br />

            {{-- <label for="puerta">Puerta:</label><br />
            <input type="text" class="form-control" placeholder="Puerta" aria-describedby="basic-addon1"
                id="puerta" name="puertas[]" /><br />

            <label for="oficina">Oficina:</label><br />
            <input type="text" class="form-control" placeholder="Oficina" aria-describedby="basic-addon1"
                id="oficina" name="oficinas[]" /><br />

            <label for="manzana">Manzana:</label><br />
            <input type="text" class="form-control" placeholder="Manzana" aria-describedby="basic-addon1"
                id="manzana" name="manzanas[]" /><br /> --}} 
                
            <label for="barrio">Barrio:</label><br />
            <input type="text" class="form-control" placeholder="Barrio" aria-describedby="basic-addon1"
                id="barrio" /><br />

            <label for="nro_tel">Telefono:</label><br />
            <input type="number" class="form-control" aria-describedby="basic-addon1" placeholder="Número de teléfono" id="nro_tel" /><br /><br />

        </div>
    </div>

            </div>
            <div class="modal-footer">
               
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
