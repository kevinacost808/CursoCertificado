<!-- Modal Mejorado -->
<div id="modalimg" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="lblTitulo"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Formulario con onsubmit -->
      <form id="detalle_form" method="post" enctype="multipart/form-data" onsubmit="return guardarEditarImg()">
        <div class="modal-body">
          <input type="hidden" name="curx_idx" id="curx_idx">

          <!-- Nombre -->
          <div class="mb-3">
            <input class="form-control" type="file" id="cur_img" name="cur_img" required>
          </div>
        </div>

        <!-- Footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" value="add">
            <i class="fa fa-check"></i> Guardar
          </button>
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fa fa-times"></i> Cancelar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>