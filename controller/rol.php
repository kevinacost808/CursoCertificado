<?php 
    require_once("../config/conexion.php");
    require_once("../models/Rol.php");

    header('Content-Type: application/json'); // Asegura respuesta en JSON
    
    $rol = new Rol();
    //Opcion de solicitud de controller
    switch($_GET["op"]){ 

        case 'combo':
            $datos=$rol->getRol();
            if(is_array( $datos )==true and count( $datos )<> 0){
                $html="<option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['rol_id']."'>".$row['rol_nombre']."</option>";
                }
                echo json_encode($html);
            }
            break;
    }
    
?>