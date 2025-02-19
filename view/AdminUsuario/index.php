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
                <a class="breadcrumb-item" href="index.html">Usuarios</a>
                <span class="breadcrumb-item active"></span>
            </nav>
        </div><!-- br-pageheader -->
        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
            <h4 class="tx-gray-800 mg-b-5">Usuarios</h4>
            <p class="mg-b-0">Mantenimiento de Usuarios</p>
        </div>

        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Usuarios</h6>
                <p class="mg-b-30 tx-gray-600">Listado de Usuarios.</p>

                <button onclick="nuevo()" class="btn btn-outline-primary"><i class="fa fa-plus-square mg-r-10"></i>Nuevo</button>
                <button onclick="plantilla()" class="btn btn-outline-success"><i class="fa fa-gear mg-r-10"></i>Subir desde excel</button>
                <br><br>
                <div class="table-wrapper">
                    <table id="usuario_data" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">Nombre</th>
                            <th class="wd-15p">Sexo</th>
                            <th class="wd-20p">Correo</th>
                            <th class="wd-20p">Telefono</th>
                            <th class="wd-20p">Rol</th>
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
    <?php require_once("modalplantilla.php") ?>
    <?php require_once("../html/MainJs.php") ?>
    <script src="adminusuario.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script>
</body>

</html>
<?php
  }else{
    header("Location:".Conexion::ruta()."view/404/");
  }

?>