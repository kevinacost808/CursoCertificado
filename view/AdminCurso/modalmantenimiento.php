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
      <form id="cursos_form" method="post">
        <div class="modal-body">
          <input type="hidden" name="cur_id" id="cur_id">
          
          <!-- Categoría -->
          <div class="mb-3">
            <label class="form-label">Categoría: <span class="text-danger">*</span></label>
            <select class="form-control select2" id="cat_id" name="cat_id" required data-placeholder="Seleccione">
            </select>
          </div>

          <!-- Nombre -->
          <div class="mb-3">
            <label class="form-label">Nombre: <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="cur_nombre" name="cur_nombre" required placeholder="Ingrese el nombre del curso">
          </div>

          <!-- Descripción -->
          <div class="mb-3">
            <label class="form-label">Descripción: <span class="text-danger">*</span></label>
            <textarea class="form-control" type="text" id="cur_descrip" name="cur_descrip" required placeholder="Ingrese la descripción"></textarea>
          </div>

          <!-- Fecha de Inicio -->
          <div class="mb-3">
            <label class="form-label">Fecha de Inicio: <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="cur_fechini" name="cur_fechini" required>
          </div>

          <!-- Fecha de Fin -->
          <div class="mb-3">
            <label class="form-label">Fecha de Fin: <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="cur_fechfin" name="cur_fechfin" required>
          </div>

          <!-- Instructor -->
          <div class="mb-3">
            <label class="form-label">Instructor: <span class="text-danger">*</span></label>
            <select class="form-control select2" id="inst_id" name="inst_id" required data-placeholder="Seleccione:">
            </select>
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
