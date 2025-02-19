<?php 
    require_once("../config/conexion.php");
    require_once("../models/Curso.php");

    header('Content-Type: application/json'); // Asegura respuesta en JSON
    
    $curso = new Curso();
    //Opcion de solicitud de controller
    switch($_GET["op"]){ 
        case 'guardarEditar':
            if(empty($_POST["cur_id"])){
                $curso->insertCurso(
                    $_POST["cat_id"],
                    $_POST["cur_nombre"],
                    $_POST["cur_descrip"],
                    $_POST["cur_fechini"],
                    $_POST["cur_fechfin"],
                    $_POST["inst_id"]
                );
                $message = "Curso insertado correctamente";
            }else{
                $curso->updateCurso(
                    $_POST["cur_id"],
                    $_POST["cat_id"],
                    $_POST["cur_nombre"],
                    $_POST["cur_descrip"],
                    $_POST["cur_fechini"],
                    $_POST["cur_fechfin"],
                    $_POST["inst_id"]
                );
                $message = "Curso actualizado correctamente";
            }

            header("Content-Type: application/json");
            echo json_encode(["status" => "success", "message" => $message]);

            break;

        case 'eliminar':
            $curso->deleteCurso($_POST['cur_id']);
            $message = "Eliminado correctamente";
            echo json_encode(["status" => "success", "message" => $message]);
            break;

        case 'mostrar':
            $datos = $curso->getCursoId($_POST['cur_id']);
            if(is_array( $datos ) == true and count( $datos ) > 0){
                foreach($datos as $row){
                    $output['cur_id'] = $row['cur_id'];
                    $output['cat_id'] = $row['cat_id'];
                    $output['cur_nombre'] = $row['cur_nombre'];
                    $output['cur_descrip'] = $row['cur_descrip'];
                    $output['cur_fechini'] = $row['cur_fechini'];
                    $output['cur_fechfin'] = $row['cur_fechfin'];
                    $output['inst_id'] = $row['inst_id'];
                }
                echo json_encode( $output );
            }
            break;

        case 'listar':
            $datos=$curso->getCursos();
            $data=Array();
            foreach($datos as $row){
                $sub_array=array();
                $sub_array[] = $row["cat_nombre"];
                $sub_array[] = '<a href="'.$row["cur_img"].'" target="_blank">'.$row["cur_nombre"].'</a>'; //PARA VERLO
                $sub_array[] = $row["cur_descrip"];
                $sub_array[] = $row["cur_fechini"];
                $sub_array[] = $row["cur_fechfin"];
                $sub_array[] = $row["inst_nombre"];
                $sub_array[] = '<button type="button" onclick="editar('.$row["cur_id"].');" id="'.$row["cur_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></div></button>';
                $sub_array[] = '<button type="button" onclick="eliminar('.$row["cur_id"].');" id="'.$row["cur_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></div></button>';
                $sub_array[] = '<button type="button" onclick="imagen('.$row["cur_id"].');" id="'.$row["cur_id"].'" class="btn btn-outline-success btn-icon"><div><i class="fa fa-file"></i></div></div></button>';
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

        case 'combo':
            $datos=$curso->getCursos();
            if(is_array( $datos )==true and count( $datos )<> 0){
                $html="<option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['cur_id']."'>".$row['cur_nombre']."</option>";
                }
                echo json_encode($html);
            }
            break;

        case 'updateImagenCurso':            
            $curso->updateImgCurso($_POST['curx_idx'], $_FILES['cur_img']);
            $message = "Actualizado correctamente";
            echo json_encode(["status" => "success", "message" => $message]);
            break;
    }
    
?>