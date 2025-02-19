<?php
    class DetalleCurso extends Conexion{
        public function insertCursoUsuario($cur_id,$usu_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "
                INSERT INTO public.td_curso_usuario (
                    curd_id,
                    cur_id,
                    usu_id,
                    fech_crea, 
                    est
                ) 
                VALUES (DEFAULT,?,?,now(),'1')
                RETURNING curd_id;
            ";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1,$cur_id);
            $stmt->bindValue(2,$usu_id);
            $stmt->execute();

            return $resultado = $stmt->fetchAll();
        }

        public function deleteDetalleCurso($curd_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "
                UPDATE 
                    td_curso_usuario
                SET
                    est = 0
                WHERE 
                    public.td_curso_usuario.curd_id=?
            ";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1,$curd_id);
            $stmt->execute();
            return $resultado = $stmt->fetchAll();
        }

        
        /* Funcion para mostrar los cursos de acuerdo a un usuario */
        public function getCursoUsuarioId($cur_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "
                SELECT 
                    public.td_curso_usuario.curd_id,
                    public.tm_curso.cur_id,
                    public.tm_curso.cur_nombre,
                    public.tm_curso.cur_descrip,
                    public.tm_curso.cur_fechini,
                    public.tm_curso.cur_fechfin,
                    public.tm_usuario.usu_id,
                    public.tm_usuario.usu_nom,
                    public.tm_usuario.usu_apep,
                    public.tm_usuario.usu_apem
                FROM 
                    public.td_curso_usuario 
                INNER JOIN 
                    public.tm_curso ON public.td_curso_usuario.cur_id = public.tm_curso.cur_id
                INNER JOIN 
                    public.tm_usuario ON public.td_curso_usuario.usu_id = public.tm_usuario.usu_id
                WHERE 
                    public.tm_curso.cur_id=? AND public.td_curso_usuario.est=1
            ";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1,$cur_id);
            $stmt->execute();
            return $resultado = $stmt->fetchAll();
        }
        
}
?>    