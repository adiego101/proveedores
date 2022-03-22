



  <!-- Modal -->
  <div class="modal fade" id="nuevoSeguro" tabindex="-1" role="dialog" aria-labelledby="modalNuevoSeguro" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalNuevoSeguro">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <fieldset>

                <h1>Seguro</h1>

        <br/>

        <br>

            <div class="row">
                <div class="col-sm">
                    <label for="poliza">Poliza:</label><br />
                    <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($seguro->poliza) ? $seguro->poliza : '' }}" class="form-control" placeholder="Ingrese la poliza" aria-describedby="basic-addon1" id="poliza" name="poliza" maxlength="20" required/><br />

                    <label for="asegurado">Asegurado:</label><br />
                    <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($seguro->asegurado) ? $seguro->asegurado : '' }}" class="form-control" placeholder="Ingrese el asegurado" aria-describedby="basic-addon1" id="asegurado" name="asegurado" maxlength="40" required/><br />
                </div>

                <div class="col-sm">
                    <label for="agencia">Agencia:</label><br />
                    <input @if ( $mode == "show") readonly @endif type="text" value="{{ isset($seguro->agencia) ? $seguro->agencia : '' }}" class="form-control" placeholder="Ingrese la agencia" aria-describedby="basic-addon1" id="agencia" name="agencia" maxlength="40" required/><br />

                    <label for="vigencia_hasta">Vigencia hasta:</label><br />
                    <input @if ( $mode == "show") readonly @endif type="date" value="{{ isset($seguro->vigencia_hasta) ? date('Y-m-d',strtotime($seguro->vigencia_hasta)) : '' }}" class="form-control" placeholder="Ingrese la fecha de vigencia" aria-describedby="basic-addon1" id="vigencia_hasta" name="vigencia_hasta" required/><br />


                </div>
            </div>
        </fieldset>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>


