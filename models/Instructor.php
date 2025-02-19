<?php
    class Instructor extends Conexion{

        public function insertInstructor($inst_nombre,$inst_apep,$inst_apem,$inst_tele,$inst_sex,$inst_correo){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "
                INSERT INTO public.tm_instructor (
                    inst_id,
                    inst_nombre,
                    inst_apep,
                    inst_apem,
                    inst_tele,
                    inst_sex,
                    fech_crea,
                    est,
                    inst_correo)
                VALUES (DEFAULT,?,?,?,?,?,now(),'1',?);
            ";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1,$inst_nombre);
            $stmt->bindValue(2,$inst_apep);
            $stmt->bindValue(3,$inst_apem);
            $stmt->bindValue(4,$inst_tele);
            $stmt->bindValue(5,$inst_sex);
            $stmt->bindValue(6,$inst_correo);
            $stmt->execute();
            return $resultado = $stmt->fetchAll();
        }

        public function updateInstructor($inst_id,$inst_nombre,$inst_apep,$inst_apem,$inst_tele,$inst_sex,$inst_correo){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "
                UPDATE 
                    public.tm_instructor
                SET
                    inst_nombre=?, 
                    inst_apep=?,
                    inst_apem=?,
                    inst_tele=?,
                    inst_sex=?,
                    inst_correo=?
                WHERE
                    public.tm_instructor.inst_id=?
            ";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1,$inst_nombre);
            $stmt->bindValue(2,$inst_apep);
            $stmt->bindValue(3,$inst_apem);
            $stmt->bindValue(4,$inst_tele);
            $stmt->bindValue(5,$inst_sex);
            $stmt->bindValue(6,$inst_correo);
            $stmt->bindValue(7,$inst_id);
            $stmt->execute();
            return $resultado = $stmt->fetchAll();
        }
        public function deleteInstructor($inst_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "
                UPDATE 
                    public.tm_instructor
                SET
                    est = 0
                WHERE 
                    public.tm_instructor.inst_id=?
            ";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1,$inst_id);
            $stmt->execute();
            return $resultado = $stmt->fetchAll();
        }
        public function getInstructor(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "
                SELECT 
                    *
                FROM 
                    public.tm_instructor
                WHERE 
                    public.tm_instructor.est=1
            ";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            return $resultado = $stmt->fetchAll();
        }
        public function getInstructorId($inst_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "
                SELECT 
                    *
                FROM 
                    public.tm_instructor
                WHERE 
                    public.tm_instructor.inst_id=?
            ";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1,$inst_id);
            $stmt->execute();
            return $resultado = $stmt->fetchAll();
        }
    }
?>    