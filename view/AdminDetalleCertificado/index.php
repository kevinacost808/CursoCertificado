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
                <a class="breadcrumb-item" href="index.html">Curso - Usuario</a>
                <span class="breadcrumb-item active"></span>
            </nav>
        </div><!-- br-pageheader -->
        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
            <h4 class="tx-gray-800 mg-b-5">Curso - Usuario</h4>
            <p class="mg-b-0">Detalle de cursos</p>
        </div>

        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Curso - Usuario</h6>
                <p class="mg-b-30 tx-gray-600">Listado curso - usuario.</p>

                <div class="row">
                  <label class="col-sm-2 form-control-label">Cursos</span></label>
                  <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                    <select class="form-control select2" id="cur_id" name="cur_id" required data-placeholder="Seleccione:"></select>
                  </div>
                  <div class="col-sm-4 mg-t-10 mg-sm-t-0">
                    <button onclick="nuevo()" class="col-sm-4 btn btn-outline-primary"><i class="fa fa-plus-square mg-r-10"></i>Add</button>
                  </div>
                  
                </div><!-- row -->
                
                <br><br>
                <div class="table-wrapper">
                    <table id="detalle_data" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Nombre Curso</th>
                            <th class="wd-20p">Nombre Usuario</th>
                            <th class="wd-15p">Fecha inicio</th>
                            <th class="wd-20p">Fecha Inicio</th>
                            <th class="wd-20p"></th>
                            <th class="wd-20p"></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div>

            </div><!-- br-pagebody -->

        </div><!-- br-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->

        <?php require_once("modalmantenimiento.php") ?>
        <?php require_once("../html/MainJs.php") ?>
        <script src="admindetalle.js" type="text/javascript"></script>
</body>

</html>
<?php
  }else{
    header("Location:".Conexion::ruta()."view/404/");
  }

?>