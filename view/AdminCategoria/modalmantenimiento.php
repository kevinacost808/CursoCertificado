<!-- Modal Mejorado -->
<div id="modalmantenimiento" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="lblTitulo"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <!-- Formulario -->
      <form id="categoria_form" method="post">
        <div class="modal-body">
          <input type="hidden" name="cat_id" id="cat_id">

          <!-- Nombre -->
          <div class="mb-3">
            <label class="form-label">Nombre: <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="cat_nombre" name="cat_nombre" required placeholder="Ingrese el nombre de la categoria">
          </div>
        </div>

        <!-- Footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
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
