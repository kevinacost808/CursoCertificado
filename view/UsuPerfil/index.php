<?php
  require_once("../../config/conexion.php");
  if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("../html/MainHead.php") ?>
    <title>Home</title>
</head>

<body>

    <?php require_once("../html/MainMenu.php") ?>

    <?php require_once("../html/MainHeader.php") ?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader pd-y-15 pd-l-20">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="index.html">Perfil</a>
                <span class="breadcrumb-item active"></span>
            </nav>
        </div><!-- br-pageheader -->
        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
            <h4 class="tx-gray-800 mg-b-5">PERFIL</h4>
            <p class="mg-b-0">Pantalla de Perfil</p>
        </div>

        <div class="br-pagebody">

            <div class="br-section-wrapper">
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Perfil</h6>
                <p class="mg-b-30 tx-gray-600">Actualice sus datos.</p>

                <div class="form-layout form-layout-1">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" id="usu_nom" name="usu_nom"required
                                    placeholder="Ingrese su nombre">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Apellido Paterno: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" id="usu_apep" name="usu_apep" required
                                    placeholder="Ingrese su apellido paterno">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Apellido Materno: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" id="usu_apem" name="usu_apem" required
                                    pplaceholder="Ingrese su apellido materno">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Correo Electronico: <span
                                        class="tx-danger">*</span></label>
                                <input readonly class="form-control" type="text" id="usu_correo" name="usu_correo" required
                                    placeholder="Ingrese su correo electronico">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Contraseña: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" id="usu_pass" name="usu_pass"
                                    placeholder="Ingrese su contraseña">
                            </div>
                        </div><!-- col-8 -->
                        <div class="col-lg-6">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Sexo: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" id="usu_sex" data-placeholder="Seleccione su sexo">
                                    <option label="Seleccione su sexo"></option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Telefono: <span class="tx-danger">*</span></label>
                                <input class="form-control" id="usu_tele" type="text" name="usu_telf"
                                    placeholder="Ingrese su telefono">
                            </div>
                        </div><!-- col-8 -->
                    </div><!-- row -->

                    <div class="form-layout-footer">
                        <button id="btnActualizar" class="btn btn-info">Actualizar</button>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->

            </div><!-- br-pagebody -->

        </div><!-- br-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->

        <?php require_once("../html/MainJs.php") ?>
        <script src="usuperfil.js" type="text/javascript"></script>
</body>

</html>
<?php
  }else{
    header("Location:".Conexion::ruta()."view/404/");
  }

?>