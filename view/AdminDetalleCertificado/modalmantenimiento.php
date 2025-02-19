<!-- Modal Mejorado -->
<div id="modalmantenimiento" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="lblTitulo"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="" id="form_detalle">
            <div class="table-wrapper">
                <table id="usuario_data" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-10p"></th>
                            <th class="wd-15p">Nombre</th>
                            <th class="wd-20p">Correo</th>
                            <th class="wd-20p">Telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            </form>
            <!-- Footer -->
            <div class="modal-footer">
                <button name="action" onclick="registrarDetalle()"  class="btn btn-primary">
                    <i class="fa fa-check"></i> Guardar
                </button>
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i> Cancelar
                </button>
            </div>
        </div>
    </div>
</div>