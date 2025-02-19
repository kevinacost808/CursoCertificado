<?php 
    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");

    header('Content-Type: application/json'); // Asegura respuesta en JSON
    
    $usuario = new Usuario();
    //Opcion de solicitud de controller
    switch($_GET["op"]){
        //Para poder mostrar los cursos de acuerdo a un usuario
        case "listarCursos":

            $datos=$usuario->getCursoPorUsuario($_POST["usu_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array=array();
                $sub_array[] = $row["cur_nombre"];
                $sub_array[] = $row["cur_fechini"];
                $sub_array[] = $row["cur_fechfin"];
                $sub_array[] = $row["inst_nombre"]." ".$row["inst_apep"];
                $sub_array[] = '<button type="button" onclick="certificado('.$row["curd_id"].');" id="'.$row["curd_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></div></button>';
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

        //Para poder mostrar los cursos de acuerdo a un usuario
        case "listarCursosTop10":

            $datos=$usuario->getCursoPorUsuarioTop10($_POST["usu_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array=array();
                $sub_array[] = $row["cur_nombre"];
                $sub_array[] = $row["cur_fechini"];
                $sub_array[] = $row["cur_fechfin"];
                $sub_array[] = '<button type="button" onclick="certificado('.$row["curd_id"].');" id="'.$row["curd_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></div></button>';
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
        
        //Para poder mostrar el detalle de 1 curso 
        case "mostrarCursoDetalle":
            $datos=$usuario->getCursoPorIdDetalle($_POST["curd_id"]);
            if(is_array($datos)==true and count($datos)<> 0){
                foreach($datos as $row){
                    $output=array();
                    $output["curd_id"] = $row["curd_id"];
                    $output["cur_id"] = $row["cur_id"];
                    $output["cur_nombre"] = $row["cur_nombre"];
                    $output["cur_descrip"] = $row["cur_descrip"];
                    $output["cur_fechini"] = $row["cur_fechini"];
                    $output["cur_fechfin"] = $row["cur_fechfin"];
                    $output["cur_img"] = $row["cur_img"];
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_apep"] = $row["usu_apep"];
                    $output["usu_apem"] = $row["usu_apem"];
                }
                echo json_encode($output);
            }
            break;

        //Para poder mostrar el perfil del usuario
        case "mostrarPerfil":
            $datos=$usuario->getusuarioId($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)<> 0){
                foreach($datos as $row){
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_apep"] = $row["usu_apep"];
                    $output["usu_apem"] = $row["usu_apem"];
                    $output["usu_correo"] = $row["usu_correo"];
                    $output["usu_sex"] = $row["usu_sex"];
                    $output["usu_pass"] = $row["usu_pass"];
                    $output["usu_tele"] = $row["usu_tele"];
                }
                echo json_encode($output);
            }
            break;

        //Para poder mostrar el perfil del usuario
        case "actualizarPerfil":
            $usuario->updateUsuarioPerfil(
                $_POST['usu_id'],
                $_POST['usu_nom'],
                $_POST['usu_apep'],
                $_POST['usu_apem'],
                $_POST['usu_pass'],
                $_POST['usu_tele'],
                $_POST['usu_sex']
            );
            break;

        //Para poder mostrar el detalle de 1 curso 
        case "totalCursos":
            $datos=$usuario->getTotalCursosUsario($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)> 0){
                foreach($datos as $row){
                    $output["total"] = $row["count"];   
                }
                echo json_encode($output);
            }
            break;

        case 'guardarEditar':
            if(empty($_POST["usu_id"])){
                $usuario->insertUsuario(
                    $_POST["usu_nom"],
                    $_POST["usu_apep"],
                    $_POST["usu_apem"],
                    $_POST["usu_sex"],
                    $_POST["usu_correo"],
                    $_POST["usu_pass"],
                    $_POST["usu_tele"],
                    $_POST["rol_id"]
                );
                $message = "Usuario insertado correctamente";
            }else{
                $usuario->updateUsuario(
                    $_POST["usu_id"],
                    $_POST["usu_nom"],
                    $_POST["usu_apep"],
                    $_POST["usu_apem"],
                    $_POST["usu_pass"],
                    $_POST["usu_tele"],
                    $_POST["usu_sex"],
                    $_POST["rol_id"]
                );
                $message = "Usuario actualizado correctamente";
            }

            header("Content-Type: application/json");
            echo json_encode(["status" => "success", "message" => $message]);

            break;

        case 'eliminar':
            $usuario->deleteUsuario($_POST['usu_id']);
            $message = "Usuario eliminado correctamente";
            echo json_encode(["status" => "success", "message" => $message]);
            break;

        case 'mostrar':
            $datos = $usuario->getUsuarioId($_POST['usu_id']);
            if(is_array( $datos ) == true and count( $datos ) > 0){
                foreach($datos as $row){
                    $output['usu_id'] = $row['usu_id'];
                    $output['usu_nom'] = $row['usu_nom'];
                    $output['usu_apep'] =$row['usu_apep'];
                    $output['usu_apem'] =$row['usu_apem'];
                    $output['usu_sex'] = $row['usu_sex'];
                    $output['usu_correo'] = $row['usu_correo'];
                    $output['usu_pass'] = $row['usu_pass'];
                    $output['usu_tele'] = $row['usu_tele'];
                    $output['rol_id'] = $row['rol_id'];
                }
                echo json_encode( $output );
            }
            break;

        case 'listar':
            $datos=$usuario->getUsuario();
            $data=Array();
            foreach($datos as $row){
                $sub_array=array();
                $sub_array[] = $row['usu_nom']." ".$row['usu_apep']." ".$row['usu_apem'];
                if($row['usu_sex']=='F'){
                    $sub_array[] = 'Femenino';
                }else{
                    $sub_array[] = 'Masculino';
                }
                $sub_array[] = $row['usu_correo'];
                $sub_array[] = $row['usu_tele'];
                $sub_array[] = $row['rol_nombre'];
                $sub_array[] = '<button type="button" onclick="editar('.$row["usu_id"].');" id="'.$row["usu_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></div></button>';
                $sub_array[] = '<button type="button" onclick="eliminar('.$row["usu_id"].');" id="'.$row["usu_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></div></button>';
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
        
            case 'listarModal':
                $datos=$usuario->getUsuarioModal($_POST['cur_id']);
                $data=Array();
                foreach($datos as $row){
                    $sub_array=array();
                    $sub_array[] = "<input type='checkbox' name='detallecheck[]' value='".$row["usu_id"]."'>";
                    $sub_array[] = $row['usu_nom']." ".$row['usu_apep']." ".$row['usu_apem'];
                    $sub_array[] = $row['usu_correo'];
                    $sub_array[] = $row['usu_tele'];
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
            $datos=$usuario->getUsuario();
            if(is_array( $datos )==true and count( $datos )<> 0){
                $html="<option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['usu_id']."'>".$row['usu_nom']." ".$row['usu_apep']." ".$row['usu_apem']."</option>";
                }
                echo json_encode($html);
            }
            break;

        //MOstrar info por correo
        case 'consultaCorreo':
            $datos = $usuario->getUsuarioCorreo($_POST['usu_correo']);
            echo json_encode( $datos);
            break;

        case 'guardarDesdeExcel':
            $usuario->insertUsuario(
                $_POST["usu_nom"],
                $_POST["usu_apep"],
                $_POST["usu_apem"],
                $_POST["usu_sex"],
                $_POST["usu_correo"],
                $_POST["usu_pass"],
                $_POST["usu_tele"],
                $_POST["rol_id"]
            );
            $message = "Usuario insertado correctamente";
            break;
    }
    
?>