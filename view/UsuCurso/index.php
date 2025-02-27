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
          <a class="breadcrumb-item" href="#">Curso</a>
          <span class="breadcrumb-item active"></span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Empresa::Curso</h4>
        <p class="mg-b-0">Mis Cursos</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Listado de Mis Cursos</h6>
          <p class="mg-b-25 mg-lg-b-50">Aqui podras encontrar tus cursos:</p>
          
          <div class="table-wrapper">
            <table id="cursos_data" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">CURSO</th>
                  <th class="wd-15p">FECHA INICIO</th>
                  <th class="wd-20p">FECHA FIN</th>
                  <th class="wd-15p">INSTRUCTOR</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>        
      </div><!-- br-pagebody -->

    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
    
    <?php require_once("../html/MainJs.php") ?>
    <script type="text/javascript" src="usucurso.js"></script>
  </body>
</html>
<?php
  }else{
    header("Location:".Conexion::ruta()."view/404/");
  }

?>