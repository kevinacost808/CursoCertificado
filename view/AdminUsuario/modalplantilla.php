<!-- Modal Mejorado -->
<div id="modalplantilla" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="lblTitulo">Subir Plantilla</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

        <div class="modal-body">
          <!-- Nombre -->
          <div class="col-lg-12">
            <div class="form-group">
              <label class="form-control-label">Subir Plantilla: <span class="tx-danger">*</span> </label>
              <form enctype="multipart/form-data">
                <input id="upload" type=file name="files[]">
              </form>
            </div>
          </div>
          

        </div>

        <!-- Footer -->
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fa fa-times"></i> Cancelar
          </button>
        </div>
    </div>
  </div>
</div>
