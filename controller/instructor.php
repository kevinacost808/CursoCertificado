<?php 
    require_once("../config/conexion.php");
    require_once("../models/Instructor.php");

    header('Content-Type: application/json'); // Asegura respuesta en JSON
    
    $instructor = new Instructor();
    //Opcion de solicitud de controller
    switch($_GET["op"]){ 
        case 'guardarEditar':
            if(empty($_POST["inst_id"])){
                $instructor->insertInstructor(
                    $_POST["inst_nombre"],
                    $_POST["inst_apep"],
                    $_POST["inst_apem"],
                    $_POST["inst_tele"],
                    $_POST["inst_sex"],
                    $_POST["inst_correo"]
                );
                $message = "Instructor insertado correctamente";
            }else{
                $instructor->updateInstructor(
                    $_POST["inst_id"],
                    $_POST["inst_nombre"],
                    $_POST["inst_apep"],
                    $_POST["inst_apem"],
                    $_POST["inst_tele"],
                    $_POST["inst_sex"],
                    $_POST["inst_correo"]
                );
                $message = "Instructor actualizado correctamente";
            }
            echo json_encode(["status" => "success", "message" => $message]);
            break;

        case 'eliminar':
            $instructor->deleteInstructor($_POST['inst_id']);
            $message = "Categoria eliminada correctamente";
            echo json_encode(["status" => "success", "message" => $message]);
            break;

        case 'mostrar':
            $datos = $instructor->getInstructorId($_POST['inst_id']);
            if(is_array( $datos ) == true and count( $datos ) > 0){
                foreach($datos as $row){
                    $output['inst_id'] = $row['inst_id'];
                    $output['inst_nombre'] = $row['inst_nombre'];
                    $output['inst_apep'] = $row['inst_apep'];
                    $output['inst_apem'] = $row['inst_apem'];
                    $output['inst_tele'] = $row['inst_tele'];
                    $output['inst_sex'] = $row['inst_sex'];
                    $output['inst_correo'] = $row['inst_correo'];
                }
                echo json_encode( $output );
            }
            break;

        case 'listar':
            $datos=$instructor->getInstructor();
            $data=Array();
            foreach($datos as $row){
                $sub_array=array();
                $sub_array[] = $row["inst_nombre"]." ".$row["inst_apep"]." ".$row["inst_apem"];
                $sub_array[] = $row["inst_tele"];
                $sub_array[] = $row["inst_sex"];
                $sub_array[] = $row["inst_correo"];
                $sub_array[] = '<button type="button" onclick="editar('.$row["inst_id"].');" id="'.$row["inst_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></div></button>';
                $sub_array[] = '<button type="button" onclick="eliminar('.$row["inst_id"].');" id="'.$row["inst_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></div></button>';
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
                $datos=$instructor->getInstructor();
                if(is_array( $datos )==true and count( $datos )<> 0){
                    $html="<option label='Seleccione'></option>";
                    foreach($datos as $row){
                        $html.= "<option value='".$row['inst_id']."'>".$row['inst_nombre']." ".$row['inst_apep']." ".$row['inst_apem']."</option>";
                    }
                    echo json_encode($html);
                }
                break;
    }
    
?>