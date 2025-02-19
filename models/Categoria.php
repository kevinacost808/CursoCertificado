<?php
    class Categoria extends Conexion{

        public function insertCategoria($cat_nombre){
            $conectar = parent::conexion();
            parent::set_names();
            $stmt = $conectar->prepare("CALL insert_categoria(?);");
            $stmt->bindValue(1,$cat_nombre);
            $stmt->execute();
        }
        public function updateCategoria($cat_id, $cat_nombre){
            $conectar = parent::conexion();
            parent::set_names();
            $stmt = $conectar->prepare("CALL update_categoria(?,?);");
            $stmt->bindValue(1,$cat_id);
            $stmt->bindValue(2,$cat_nombre);
            $stmt->execute();
        }
        //TODO eliminar categoria y manejar errores
        public function deleteCategoria($cat_id){
            try {
                $conectar = parent::conexion();
                parent::set_names();
                $stmt = $conectar->prepare("CALL delete_categoria(?)");
                $stmt->execute([$cat_id]);
        
                return ["status" => "success", "message" => "Categoría eliminada correctamente"];
            } catch (PDOException $e) {
                return ["status" => "error", "message" => "Error al eliminar la categoría: " . $e->getMessage()];
            }
        }        
        public function getCategoria(){
            $conectar = parent::conexion();
            parent::set_names();
            $stmt = $conectar->prepare("SELECT * FROM get_categoria()"); 
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getCategoriaId($cat_id){
            $conectar = parent::conexion();
            parent::set_names();
            $stmt = $conectar->prepare("select * from getCategoriaId(?)");
            $stmt->bindValue(1,$cat_id);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }
?>    