<?php 
class Usuario extends Conexion{
    public function login(){
        $conectar = parent::conexion();
        parent::set_names();
        if(isset($_POST["enviar"])){
            $correo = $_POST["usu_correo"];
            $pass = $_POST["usu_pass"];
            if(empty($correo) and empty($pass)){
                header("Location:".Conexion::ruta()."index.php?m=2");
                exit;
            }else{
                $stmt = $conectar->prepare('select * from validar_login(?,?)');
                $stmt->bindValue(1,$correo);
                $stmt->bindValue(2,"$pass");
                $stmt->execute();
                $resultado = $stmt->fetch();
                if(is_array( $resultado ) and $resultado>0){
                    $_SESSION["usu_id"] =$resultado["usu_id"];
                    $_SESSION["usu_nom"] =$resultado["usu_nom"];
                    $_SESSION["usu_ape"] =$resultado["usu_ape"];
                    $_SESSION["usu_correo"] =$resultado["usu_correo"];
                    $_SESSION["rol_id"] =$resultado["rol_id"];
                    header("Location:".Conexion::ruta()."view/UsuHome/");
                    exit;
                }else{
                    header("Location:".Conexion::ruta()."index.php?m=1");
                    exit;
                }
            }
        }
    }

    /* Funcion para mostrar los cursos de acuerdo a un usuario */
    public function getCursoPorUsuario($usu_id){
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
                public.tm_usuario.usu_apem,
                public.tm_instructor.inst_nombre,
                public.tm_instructor.inst_apep,
                public.tm_instructor.inst_apem
            FROM 
                public.td_curso_usuario 
            INNER JOIN 
                public.tm_curso ON public.td_curso_usuario.cur_id = public.tm_curso.cur_id
            INNER JOIN 
                public.tm_usuario ON public.td_curso_usuario.usu_id = public.tm_usuario.usu_id
            INNER JOIN
                public.tm_instructor ON public.td_curso_usuario.inst_id = public.tm_instructor.inst_id
            WHERE 
                public.tm_usuario.usu_id=?
        ";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1,$usu_id);
        $stmt->execute();
        return $resultado = $stmt->fetchAll();
    }

    /* Funcion para mostrar los cursos de acuerdo a un usuario */
    public function getCursoPorUsuarioTop10($usu_id){
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
                public.tm_usuario.usu_id=? AND public.td_curso_usuario.est=1
            LIMIT 10
        ";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1,$usu_id);
        $stmt->execute();
        return $resultado = $stmt->fetchAll();
    }

    /* Funcion para obtener el detalle del curso por id */
    public function getCursoPorIdDetalle($curd_id){
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
                public.tm_curso.cur_img,
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
                public.td_curso_usuario.curd_id=?
        ";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1,$curd_id);
        $stmt->execute();
        return $resultado = $stmt->fetchAll();
    }

    /* Funcion para obtener el total de cursos por usuario */
    public function getTotalCursosUsario($usu_id){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "
            SELECT 
                count(*)
            FROM 
                public.td_curso_usuario 
            WHERE 
                public.td_curso_usuario.usu_id=?
        ";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1,$usu_id);
        $stmt->execute();
        return $resultado = $stmt->fetchAll();
    }

    public function insertUsuario($usu_nombre,$usu_apep,$usu_apem,$usu_sex,$usu_correo,$usu_pass,$usu_tele,$rol_id){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "
            INSERT INTO public.tm_usuario (
                usu_id, 
                usu_nom, 
                usu_apep, 
                usu_apem, 
                usu_sex, 
                usu_correo, 
                usu_pass, 
                fech_crea, 
                est,
                usu_tele, 
                rol_id
            ) 
            VALUES (DEFAULT,?,?,?,?,?,?,now(),'1',?,?);
        ";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1,$usu_nombre);
        $stmt->bindValue(2,$usu_apep);
        $stmt->bindValue(3,$usu_apem);
        $stmt->bindValue(4,$usu_sex);
        $stmt->bindValue(5,$usu_correo);
        $stmt->bindValue(6,$usu_pass);
        $stmt->bindValue(7,$usu_tele);
        $stmt->bindValue(8,$rol_id);
        $stmt->execute();
        return $resultado = $stmt->fetchAll();
    }

    /* Funcion para actualizar los datos del usuario por su id */
    public function updateUsuarioPerfil($usu_id,$usu_nom,$usu_apep,$usu_apem,$usu_pass,$usu_tele, $usu_sex){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "
            UPDATE 
                public.tm_usuario 
            SET
                usu_nom=?,
                usu_apep=?,
                usu_apem=?,
                usu_pass=?,
                usu_tele=?,
                usu_sex=?
            WHERE 
                public.tm_usuario.usu_id=?
        ";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1,$usu_nom);
        $stmt->bindValue(2,$usu_apep);
        $stmt->bindValue(3,$usu_apem);
        $stmt->bindValue(4,$usu_pass);
        $stmt->bindValue(5,$usu_tele);
        $stmt->bindValue(6,$usu_sex);
        $stmt->bindValue(7,$usu_id);

        $stmt->execute();
        return $resultado = $stmt->fetchAll();
    }

    /* Funcion para actualizar los datos del usuario por su id */
    public function updateUsuario($usu_id,$usu_nom,$usu_apep,$usu_apem,$usu_pass,$usu_tele, $usu_sex, $rol_id){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "
            UPDATE 
                public.tm_usuario 
            SET
                usu_nom=?,
                usu_apep=?,
                usu_apem=?,
                usu_pass=?,
                usu_tele=?,
                usu_sex=?,
                rol_id=?
            WHERE 
                public.tm_usuario.usu_id=?
        ";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1,$usu_nom);
        $stmt->bindValue(2,$usu_apep);
        $stmt->bindValue(3,$usu_apem);
        $stmt->bindValue(4,$usu_pass);
        $stmt->bindValue(5,$usu_tele);
        $stmt->bindValue(6,$usu_sex);
        $stmt->bindValue(7,$rol_id);
        $stmt->bindValue(8,$usu_id);

        $stmt->execute();
        return $resultado = $stmt->fetchAll();
    }

    public function deleteUsuario($usu_id){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "
            UPDATE 
                public.tm_usuario 
            SET
                est = 0
            WHERE 
                public.tm_usuario.usu_id=?
        ";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1,$usu_id);
        $stmt->execute();
        return $resultado = $stmt->fetchAll();
    }

    public function getUsuario(){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "
                SELECT 
                    public.tm_usuario.usu_id,
                    public.tm_usuario.usu_nom,
                    public.tm_usuario.usu_apep,
                    public.tm_usuario.usu_apem,
                    public.tm_usuario.usu_sex,
                    public.tm_usuario.usu_correo,
                    public.tm_usuario.usu_pass,
                    public.tm_usuario.usu_tele,
                    public.tm_rol.rol_nombre
                FROM 
                    public.tm_usuario 
                INNER JOIN 
                    public.tm_rol ON public.tm_rol.rol_id =  public.tm_usuario.rol_id
                WHERE 
                    public.tm_usuario.est=1
        ";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $resultado = $stmt->fetchAll();
    }

    public function getUsuarioModal($cur_id){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "
                SELECT 
                    u.usu_id,
                    u.usu_nom,
                    u.usu_apep,
                    u.usu_apem,
                    u.usu_sex,
                    u.usu_correo,
                    u.usu_tele
                FROM 
                    public.tm_usuario u
                WHERE 
                    u.est = 1
                    AND u.usu_id NOT IN (
                        SELECT cu.usu_id 
                        FROM public.td_curso_usuario cu
                        WHERE cu.cur_id = ?
                        AND est=1
                    );
                ";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1,$cur_id);
        $stmt->execute();
        return $resultado = $stmt->fetchAll();
    }

    /* Funcion para obtener los datos del usuario por su id */
    public function getUsuarioId($usu_id){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "
            SELECT 
                *
            FROM 
                public.tm_usuario 
            WHERE 
                est=1 AND public.tm_usuario.usu_id=?
        ";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1,$usu_id);
        $stmt->execute();
        return $resultado = $stmt->fetchAll();
    }

    /* Funcion para obtener los datos del usuario por su correo */
    public function getUsuarioCorreo($usu_correo){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "
            SELECT 
                *
            FROM 
                public.tm_usuario 
            WHERE 
                est = 1 AND public.tm_usuario.usu_correo=?
        ";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1,$usu_correo);
        $stmt->execute();
        return $resultado = $stmt->fetchAll();
    }

}
?>
    
    
