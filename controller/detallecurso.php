<?php 
    require_once("../config/conexion.php");
    require_once("../models/DetalleCurso.php");

    header('Content-Type: application/json'); // Asegura respuesta en JSON
    
    $detalleCurso = new DetalleCurso();
    //Opcion de solicitud de controller
    switch($_GET["op"]){ 
        case 'guardar':
            $datos = explode(',', $_POST['usu_id']);

            $data = Array();
            foreach($datos as $row){
                $sub_array = Array();
                $idx = $detalleCurso->insertCursoUsuario($_POST['cur_id'],$row);
                $sub_array[] = $idx;
                $data[] = $sub_array;
            };
            echo json_encode($data);
            break;

        case "generarQr":
            require 'phpqrcode/qrlib.php';
            QRcode::png(conexion::ruta()."view/Certificado/index.php?curd_id=".$_POST["curd_id"],"../public/qr/".$_POST["curd_id"].".png",'L',32,5);//texto qr, el id para ruta
            break;

        case 'eliminar':
            $detalleCurso->deleteDetalleCurso($_POST['curd_id']);
            $message = "Eliminado correctamente";
            echo json_encode(["status" => "success", "message" => $message]);
            break;

        case "listarCursosUsuarioId":

            $datos=$detalleCurso->getCursoUsuarioId($_POST["cur_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array=array();
                $sub_array[] = $row["curd_id"];
                $sub_array[] = $row["cur_nombre"];
                $sub_array[] = $row["usu_nom"]." ".$row["usu_apep"]." ".$row["usu_apem"];
                $sub_array[] = $row["cur_fechini"];
                $sub_array[] = $row["cur_fechfin"];
                $sub_array[] = '<button type="button" onclick="certificado('.$row["curd_id"].');" id="'.$row["curd_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></div></button>';
                $sub_array[] = '<button type="button" onclick="eliminar('.$row["curd_id"].');" id="'.$row["curd_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count( $data ),
                "iTotalDisplayRecords"=>count( $data ),
                "aaData"=>$data
            );
            
            echo json_encode($results);

            break;
            
    }        
    
?>