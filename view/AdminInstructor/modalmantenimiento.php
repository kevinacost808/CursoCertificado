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
      <form id="instructor_form" method="post">
        <div class="modal-body">
            <input type="hidden" name="inst_id" id="inst_id">

            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Nombre: <span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="inst_nombre" name="inst_nombre" required placeholder="Ingrese el nombre del instructor">
            </div>
            
            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Apellido Paterno: <span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="inst_apep" name="inst_apep" required placeholder="Ingrese el apellido paterno">
            </div>
            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Apellido Materno: <span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="inst_apem" name="inst_apem" required placeholder="Ingrese el apellido paterno">
            </div>
            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Telefono: <span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="inst_tele" name="inst_tele" required placeholder="Ingrese el telefono">
            </div>
            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Sexo: <span class="text-danger">*</span></label>
                <select class="form-control select2" id="inst_sex" name="inst_sex" required data-placeholder="Seleccione su sexo:">
                    <option label="seleccione"></option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
            </div>
            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Correo: <span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="inst_correo" name="inst_correo" required placeholder="Ingrese el correo">
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
        </div>
      </form>
    </div>
  </div>
</div>
