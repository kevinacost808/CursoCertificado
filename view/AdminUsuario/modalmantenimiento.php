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
      <form id="usuario_form" method="post">
        <div class="modal-body">
          <input type="hidden" name="usu_id" id="usu_id">

          <!-- Nombre -->
          <div class="mb-3">
            <label class="form-label">Nombre: <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="usu_nom" name="usu_nom" required placeholder="Ingrese el nombre del curso">
          </div>

          <!-- Descripción -->
          <div class="mb-3">
            <label class="form-label">Apellido Paterno: <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="usu_apep" name="usu_apep" required placeholder="Ingrese el apellido paterno">
          </div>

          <!-- Descripción -->
          <div class="mb-3">
            <label class="form-label">Apellido Materno: <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="usu_apem" name="usu_apem" required placeholder="Ingrese el apellido materno">
          </div>

          <!-- Instructor -->
          <div class="mb-3">
            <label class="form-label">Sexo: <span class="text-danger">*</span></label>
            <select class="form-control select2" id="usu_sex" name="usu_sex" required data-placeholder="Seleccione:">
              <option label="Seleccione su sexo"></option>
              <option value="F">Femenino</option> 
              <option value="M">Masculino</option>  
          </select>
          </div>

          <!-- Descripción -->
          <div class="mb-3">
            <label class="form-label">Correo: <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="usu_correo" name="usu_correo" required placeholder="Ingrese su correo">
          </div>

          <!-- Descripción -->
          <div class="mb-3">
            <label class="form-label">Password: <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="usu_pass" name="usu_pass" required placeholder="Ingrese su contraseña">
          </div>

          <!-- Descripción -->
          <div class="mb-3">
            <label class="form-label">Telefono: <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="usu_tele" name="usu_tele" required placeholder="Ingrese el telefono">
          </div>

          <!-- Instructor -->
          <div class="mb-3">
            <label class="form-label">Rol: <span class="text-danger">*</span></label>
            <select class="form-control select2" id="rol_id" name="rol_id" required data-placeholder="Seleccione:">
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
