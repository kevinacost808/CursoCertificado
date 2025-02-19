<?php 
  require_once("config/conexion.php");
  if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){
    require_once("models/Usuario.php");
    $usuario = new Usuario();
    $usuario->login();
  }

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bracket">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:url" content="http://themepixels.me/bracket">
    <meta property="og:title" content="Bracket">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta property="og:image" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Empresa::Login</title>

    <!-- vendor css -->
    <link href="public/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="public/lib/Ionicons/css/ionicons.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="public/css/bracket.css">
</head>

<body>

    <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

        <form action="" method="post">
            <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">

              <?php 
                if(isset($_GET["m"])){
                  switch($_GET["m"]){
                    case "1":;
                    ?>
                      <div class="alert alert-danger" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          <div class="d-flex align-items-center justify-content-start">
                              <i class="icon ion-ios-checkmark alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                              <span><strong>Error!</strong> Contraseña incorrecta.</span>
                          </div><!-- d-flex -->
                      </div><!-- alert -->

                    <?php  
                    break;
                    case "2":;
                    ?>
                      <div class="alert alert-warning" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          <div class="d-flex align-items-center justify-content-start">
                              <i class="icon ion-ios-checkmark alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                              <span><strong>Error</strong> Campos Vacios.</span>
                          </div><!-- d-flex -->
                      </div><!-- alert -->
                    <?php
                    break;
                  }
                }
              ?>

                <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal">[</span> Empresa
                    <span class="tx-normal">]</span></div>
                <div class="tx-center mg-b-30">Certificado y diplomas</div>

                <div class="form-group">
                    <input type="text" id="usu_correo" name="usu_correo" class="form-control"
                        placeholder="Ingrese correo electrónico">
                </div><!-- form-group -->
                <div class="form-group">
                    <input type="password" id="usu_pass" name="usu_pass" class="form-control"
                        placeholder="Ingrese contraseña">
                    <!--<a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a> -->
                </div><!-- form-group -->
                <input type="hidden" name="enviar" class="form-control" value="si">
                <button type="submit" class="btn btn-info btn-block">Acceder</button>

                <div class="mg-t-60 tx-center">Not yet a member? <a href="" class="tx-info">Sign Up</a></div>
            </div><!-- login-wrapper -->
        </form>
    </div><!-- d-flex -->

    <script src="public/lib/jquery/jquery.js"></script>
    <script src="public/lib/popper.js/popper.js"></script>
    <script src="public/lib/bootstrap/bootstrap.js"></script>

</body>

</html>