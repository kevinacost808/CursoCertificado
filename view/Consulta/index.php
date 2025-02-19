<!DOCTYPE html>
<html lang="en" class="pos-relative">
  <head>
    <?php require_once("../html/MainHead.php") ?>

    <title>404</title>

  </head>

  <body class="pos-relative">

    <div class="ht-100v d-flex align-items-center justify-content-center">
      <div class="wd-lg-70p wd-xl-50p tx-center pd-x-40">
        <h1 class="tx-100 tx-xs-140 tx-normal tx-inverse tx-roboto mg-b-0">Consulta!</h1>
        <h5 class="tx-xs-24 tx-normal tx-info mg-b-30 lh-5">Ingrese correo para validar certificado</h5>
        
        <div class="d-flex justify-content-center">
          <div class="input-group wd-xs-300">
            <input id="usu_correo" name="usu_correo" type="text" class="form-control" placeholder="Correo">
            <div class="input-group-btn">
              <button id="btnConsultar" class="btn btn-info"><i class="fa fa-search"></i></button>
            </div><!-- input-group-btn -->
          </div><!-- input-group -->
        </div><!-- d-flex -->
        <br>
        <div class="row row-sm mg-t-20" id="divpanel">
                <div class="col-12">
                    <div class="card pd-0 bd-0 shadow-base">
                        <div class="pd-x-30 pd-t-30 pd-b-15">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Certificados</h6>
                                    <p class="mg-b-0">Visualización de certificados</p>
                                </div>
                            </div><!-- d-flex -->
                        </div>
                        <div class="br-pagebody">
                            <div class="br-section-wrapper">
                                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Listado de Cursos de:</h6>
                                <p class="mg-b-25 mg-lg-b-50" id="lblDatos"></p>

                                <div class="table-wrapper">
                                    <table id="cursos_data" class="table display responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p">CURSO</th>
                                                <th class="wd-15p">FECHA INICIO</th>
                                                <th class="wd-20p">FECHA FIN</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- br-pagebody -->
                    </div><!-- card -->
                </div>
            </div>

      </div>
    </div><!-- ht-100v -->

    <?php require_once("../html/MainJs.php") ?>
    <script src="consulta.js" type="text/javascript"></script>
  </body>
</html>
