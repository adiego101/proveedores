<!-- Modal -->
@if ($mode != 'show')

  <form id="addformproducto">
      @endif
    @csrf
  <div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="modalNuevoProducto" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="modalNuevoProducto">Nuevo Producto</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <fieldset>
                <div class="row">
                    <div class="col-sm">
                        <label for="producto_elaborado">Producto elaborado:</label><br>
                        <input @if ( $mode == "show") readonly @endif list="productos" name="producto_elaborado" id="producto_elaborado" value="{{ isset($producto->producto_elaborado) ? $producto->producto_elaborado : '' }}"  class="form-control" placeholder="Ingrese o seleccione el producto que produce" required>
                        <datalist id="productos">
                            @forelse($productos as $producto2)

                                <option value="{{$producto2->producto_elaborado}}">

                            @empty
                                <option value=" ">
                            @endforelse
                        </datalist>
                        <br>

                        <label for="rnpa">RNPA:</label><br>
                        <input @if ( $mode == "show") readonly @endif type="text" class="form-control" value="{{ isset($producto->rnpa) ? $producto->rnpa : '' }}" aria-describedby="basic-addon1" id="rnpa" name="rnpa" placeholder="Ingrese el RNPA" maxlength="8"><br>
                    </div>

                    <div class="col-sm">
                        <label for="Producida_unidad">Unidad producida:</label><br>
                        <input @if ( $mode == "show") readonly @endif type="text" onkeypress="return valideKey(event);" value="{{ isset($producto->Producida_unidad) ? $producto->Producida_unidad : '' }}" class="form-control" aria-describedby="basic-addon1" id="Producida_unidad"
                        name="Producida_unidad" placeholder="Ingrese la cantidad de unidades producidas" maxlength="9" required><br>

                        <label for="capacidad_produccion_total">Capacidad de producción total:</label><br>
                        <input @if ( $mode == "show") readonly @endif type="text" onkeypress="return valideKey(event);" value="{{ isset($producto->capacidad_produccion_total) ? $producto->capacidad_produccion_total : '' }}" class="form-control" aria-describedby="basic-addon1" id="capacidad_produccion_total" name="capacidad_produccion_total" placeholder="Ingrese la producción total" maxlength="9"><br>
                    </div>
                </div>
                <br>
            </fieldset>

        </div>
        <div class="modal-footer">
            @if ($mode != 'show')
            <button type="submit" class="btn btn-success">Guardar</button>

            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            @else
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>

            @endif
             </div>
      </div>
    </div>
  </div>
  @if ($mode != 'show')

</form>
@endif
@push('js')

<script>

        $(document).ready(  function()
            {
                $('#addformproducto').on('submit', function(e)
                {
                   e.preventDefault();
                $("button").prop("disabled", true);

                    $.ajax({
                        type: "post",
                        url: "{{url('crearProductos/'.$id)}}",
                        data: $('#addformproducto').serialize(),
                        success: function (response) {

                            $('#nuevoProducto').modal('hide')
                            $('.yajra-productos').DataTable().ajax.reload();
                            $('#producto_elaborado').val('');
                            $('#rnpa').val('');
                            $('#Producida_unidad').val('');
                            $('#capacidad_produccion_total').val('');

                            Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Producto Guardado',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true

                            })
                            $("button").prop("disabled", false);
                        },
                        error: function(error){
                            //console.log(error)
                        $("button").prop("disabled", false);
                            alert("ERROR!! Producto no guardado")
                        }
                    });
                }
                );
            }
        );

    </script>

@endpush
