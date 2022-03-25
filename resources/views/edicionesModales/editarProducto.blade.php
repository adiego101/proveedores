



  <!-- Modal -->
  <form id="editarprod">
    @csrf
  <div class="modal fade" id="editarproducto" tabindex="-1" role="dialog" aria-labelledby="modalEditarProducto" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditarProducto">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <fieldset>
                <div class="row">
                    <div class="col-sm">
                        <label for="producto_elaborado1">Producto elaborado:</label><br>
                        <input @if ( $mode == "show") readonly @endif list="productos" name="producto_elaborado1" id="producto_elaborado1" value="{{ isset($producto->producto_elaborado) ? $producto->producto_elaborado : '' }}"  class="form-control" placeholder="Ingrese o seleccione el producto que produce" required>
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
                        name="Producida_unidad1" placeholder="Ingrese la cantidad de unidades producidas" maxlength="9" required><br>

                        <label for="capacidad_produccion_total1">Capacidad de producción total:</label><br>
                        <input @if ( $mode == "show") readonly @endif type="text" onkeypress="return valideKey(event);" value="{{ isset($producto->capacidad_produccion_total) ? $producto->capacidad_produccion_total : '' }}" class="form-control" aria-describedby="basic-addon1" id="capacidad_produccion_total1" name="capacidad_produccion_total1" placeholder="Ingrese la producción total" maxlength="9"><br>
                    </div>
                </div>
                <br>
            </fieldset>

        </div>
        <div class="modal-footer">
            <input type="hidden" id="editar_producto">
                    <input type="hidden" id="ver_producto">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>
@push('js')
    <script>
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
                let id_registro = $("#editar_producto").val();
                console.log("{{ url('guardarProductos/') }}/" + id_registro);

                $.ajax({
                    type: "post",
                    url: "{{ url('guardarProductos/') }}/" + id_registro,
                    data: $('#editarprod').serialize(),
                    success: function(response) {
                        console.log(response)
                        $('#editarproducto').modal('hide')
                        alert("Producto Guardado");
                        $('.yajra-productos').DataTable().ajax.reload();

                    },
                    error: function(error) {
                        console.log(error)
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
                console.log(response);

                console.log(response['rnpa']);



                $('#producto_elaborado1').val(Number(response['producto_elaborado']));
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
