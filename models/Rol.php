<?php
    class Rol extends Conexion{

        public function getRol(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "
                SELECT 
                    *
                FROM 
                    public.tm_rol
            ";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            return $resultado = $stmt->fetchAll();
        }
    }
?>    