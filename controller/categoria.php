<?php 
    require_once("../config/conexion.php");
    require_once("../models/Categoria.php");

    header('Content-Type: application/json'); // Asegura respuesta en JSON
    
    $categoria = new Categoria();
    //Opcion de solicitud de controller
    switch($_GET["op"]){ 
        case 'guardarEditar':
            if(empty($_POST["cat_id"])){
                $categoria->insertCategoria(
                    $_POST["cat_nombre"]
                );
                $message = "Categoria insertada correctamente";
            }else{
                $categoria->updateCategoria(
                    $_POST["cat_id"],
                    $_POST["cat_nombre"]
                );
                $message = "Categoria actualizada correctamente";
            }
            echo json_encode(["status" => "success", "message" => $message]);
            break;

        case 'eliminar': 
            $response = $categoria->deleteCategoria($_POST['cat_id']); 
            echo json_encode($response); 
            break;
                

        case 'mostrar':
            $datos = $categoria->getCategoriaId($_POST['cat_id']);
            if(is_array( $datos ) == true and count( $datos ) > 0){
                foreach($datos as $row){
                    $output['cat_id'] = $row['cat_id'];
                    $output['cat_nombre'] = $row['cat_nombre'];
                }
                echo json_encode( $output );
            }
            break;

        case 'listar':
            $datos=$categoria->getCategoria();
            $data=Array();
            foreach($datos as $row){
                $sub_array=array();
                $sub_array[] = $row["cat_nombre"];
                $sub_array[] = '<button type="button" onclick="editar('.$row["cat_id"].');" id="'.$row["cat_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></div></button>';
                $sub_array[] = '<button type="button" onclick="eliminar('.$row["cat_id"].');" id="'.$row["cat_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></div></button>';
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
            $datos=$categoria->getCategoria();
            if(is_array( $datos )==true and count( $datos )<> 0){
                $html="<option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['cat_id']."'>".$row['cat_nombre']."</option>";
                }
                echo json_encode($html);
            }
            break;
}
    
?>