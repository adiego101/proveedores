<!-- Modal -->
  @if ($mode != 'show')
  <form id="editarprod">
@endif
    @csrf
  <div class="modal fade" id="editarproducto" tabindex="-1" role="dialog" aria-labelledby="modalEditarProducto" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="modalEditarProducto">Producto</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <fieldset>
                <div class="row">
                    <div class="col-sm">
                        <label for="producto_elaborado1">Producto elaborado:</label><br>
                        <input @if ( $mode == "show") readonly @endif list="productos" name="producto_elaborado1" id="producto_elaborado1" value="{{ isset($producto->producto_elaborado) ? $producto->producto_elaborado : '' }}"  class="form-control" placeholder="Ingrese o seleccione el producto que produce" maxlength="30" required>
                        <datalist id="productos1">
                            @forelse($productos as $producto2)

                                <option value="{{$producto2->producto_elaborado}}">

                            @empty
                                <option value=" ">
                            @endforelse
                        </datalist>
                        <br>

                        <label for="rnpa1">RNPA:</label><br>
                        <input @if ( $mode == "show") readonly @endif type="text" class="form-control" value="{{ isset($producto->rnpa) ? $producto->rnpa : '' }}" aria-describedby="basic-addon1" id="rnpa1" name="rnpa1" placeholder="Ingrese el RNPA" maxlength="8"><br>
                    </div>

                    <div class="col-sm">
                        <label for="Producida_unidad1">Unidad producida:</label><br>
                        <input @if ( $mode == "show") readonly @endif type="text" onkeypress="return valideKey(event);" value="{{ isset($producto->Producida_unidad) ? $producto->Producida_unidad : '' }}" class="form-control" aria-describedby="basic-addon1" id="Producida_unidad1"
                        name="Producida_unidad1" placeholder="Ingrese la cantidad de unidades producidas" maxlength="9" required>
                        <small class="small" id="small-Producida_unidad1"></small>
                        <br>

                        <label for="capacidad_produccion_total1">Capacidad de producción total:</label><br>
                        <input @if ( $mode == "show") readonly @endif type="text" onkeypress="return valideKey(event);" value="{{ isset($producto->capacidad_produccion_total) ? $producto->capacidad_produccion_total : '' }}" class="form-control" aria-describedby="basic-addon1" id="capacidad_produccion_total1" name="capacidad_produccion_total1" placeholder="Ingrese la producción total" maxlength="9">
                        <small class="small" id="small-capacidad_produccion_total1"></small>
                        <br>
                    </div>
                </div>
                <br>
            </fieldset>

        </div>
        <div class="modal-footer">
            <input type="hidden" id="editar_producto">
            <input type="hidden" id="ver_producto">
            @if ($mode != 'show')
            <button type="submit" class="btn btn-success">Guardar</button>

            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            @else
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>

            @endif   </div>
      </div>
    </div>
  </div>
  @if ($mode != 'show')
</form>
@endif

@push('js')

    <script>


        $('#Producida_unidad1').keyup(validarUnidadProducida);

        function validarUnidadProducida() {

            if (!(/^[0-9]+$/.test($('#Producida_unidad1').val()))) {
                if($('#Producida_unidad1').val() != ""){

                mostrarError('#Producida_unidad1', '#small-Producida_unidad1', '<div class="alert alert-danger mt-3 pt-1">La <strong>unidad producida</strong> debe contener solamente dígitos numéricos.</div>');
                return false;
                }
            }
            ocultarError('#Producida_unidad1', '#small-Producida_unidad1');
            return true;
        }


        $('#capacidad_produccion_total1').keyup(validarProduccionTotal);

        function validarProduccionTotal() {

            if (!(/^[0-9]+$/.test($('#capacidad_produccion_total1').val()))) {
                if($('#capacidad_produccion_total1').val() != ""){

                mostrarError('#capacidad_produccion_total1', '#small-capacidad_produccion_total1', '<div class="alert alert-danger mt-3 pt-1">La <strong>producción total</strong> debe contener solamente dígitos numéricos.</div>');
                return false;
                }
            }
            ocultarError('#capacidad_produccion_total1', '#small-capacidad_produccion_total1');
            return true;
        }




        $(document).on("click", ".btn_editar_producto", function() {

            //Obtenemos el numero de la fila que queremos modificar
            let id = $("#editar_producto").val();

        });

        $(document).on("click", ".btn_ver_producto", function() {

            //Obtenemos el numero de la fila que queremos modificar
            let id = $("#ver_producto").val();
        });


        $(document).ready(function() {
            $('#editarprod').on('submit', function(e) {

               e.preventDefault();
                $("button").prop("disabled", true);
                let id_registro = $("#editar_producto").val();

                $.ajax({
                    type: "post",
                    url: "{{ url('guardarProductos/') }}/" + id_registro,
                    data: $('#editarprod').serialize(),
                    success: function(response) {

                        $('#editarproducto').modal('hide')

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Producto Modificado',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })

                        $("button").prop("disabled", false);

                        $('.yajra-productos').DataTable().ajax.reload();

                    },
                    error: function(error) {
                        //console.log(error)
                        $("button").prop("disabled", false);
                        alert("ERROR!! Producto no guardado")
                    }
                });
            });
        });
        function verProducto(id_registro) {

            $.ajax({
                url: "{{ url('verProductos/') }}/" + id_registro,
                success: function(response) {

                    abrirModalverProducto(response);
                }
            });

            function abrirModalverProducto(response) {

                $('#editarproducto').modal('show');

                $('#producto_elaborado1').val(response['producto_elaborado']);
                $('#rnpa1').val(response['rnpa']);
                $('#Producida_unidad1').val(response['Producida_unidad']);
                $('#capacidad_produccion_total1').val(response['capacidad_produccion_total']);

                $('#editar_producto').val(response['id_producto']);

                $('#ver_producto').val(response['id_producto']);

                $('.yajra-productos').DataTable().ajax.reload();

            }
        }

    </script>

@endpush
