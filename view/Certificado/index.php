<!DOCTYPE html>
<html lang="es" class="pos-relative">

<head>
    <?php require_once("../html/MainHead.php") ?>
    <title>Certificado</title>
</head>

<body class="pos-relative">

    <div class="ht-100v d-flex align-items-center justify-content-center">
        <div class="wd-lg-70p wd-xl-50p tx-center pd-x-40">
            <h1 class="tx-100 tx-xs-140 tx-normal tx-inverse tx-roboto mg-b-0">

            <canvas id="canvas" width="900" height="600" class="img-fluid" alt="Responsive image">

            </canvas>

                <!--<img src="../../public/img/certificado.png" class="img-fluid" alt="Responsive image">-->
            </h1>
            <br>
            <p class="tx-16 mg-b-30 text-justify" id="cur_descrip">
            </p>
            <div class="form-layout-footer">
                <button class="btn btn-outline-success" id="btnpdf">PDF</button>
                <button class="btn btn-outline-info" id="btnpng">PNG</button>
            </div><!-- form-layout-footer -->
        </div>

    </div><!-- ht-100v -->

    <?php require_once("../html/MainJs.php") ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="certificado.js" type="text/javascript"></script>
    
</body>

</html>