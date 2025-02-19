<?php
    class Curso extends Conexion{

        public function insertCurso($cat_id,$cur_nombre,$cur_descrip,$cur_fechini,$cur_fechfin,$inst_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "
                INSERT INTO public.tm_curso (
                    cur_id, 
                    cat_id, 
                    cur_nombre, 
                    cur_descrip, 
                    cur_fechini, 
                    cur_fechfin, 
                    cur_img,
                    inst_id, 
                    fech_crea, 
                    est
                ) 
                VALUES (DEFAULT,?,?,?,?,?,'../../public/img/certificado.png',?,now(),'1');
            ";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1,$cat_id);
            $stmt->bindValue(2,$cur_nombre);
            $stmt->bindValue(3,$cur_descrip);
            $stmt->bindValue(4,$cur_fechini);
            $stmt->bindValue(5,$cur_fechfin);
            $stmt->bindValue(6,$inst_id);
            $stmt->execute();
            return $resultado = $stmt->fetchAll();
        }

        public function updateCurso($cur_id, $cat_id,$cur_nombre,$cur_descrip,$cur_fechini,$cur_fechfin,$inst_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "
                UPDATE 
                    public.tm_curso 
                SET
                    cat_id=?, 
                    cur_nombre=?,
                    cur_descrip=?,
                    cur_fechini=?,
                    cur_fechfin=?,
                    inst_id=?
                WHERE
                    public.tm_curso.cur_id=?
            ";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1,$cat_id);
            $stmt->bindValue(2,$cur_nombre);
            $stmt->bindValue(3,$cur_descrip);
            $stmt->bindValue(4,$cur_fechini);
            $stmt->bindValue(5,$cur_fechfin);
            $stmt->bindValue(6,$inst_id);
            $stmt->bindValue(7,$cur_id);
            $stmt->execute();
            return $resultado = $stmt->fetchAll();
        }
        public function deleteCurso($cur_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "
                UPDATE 
                    public.tm_curso 
                SET
                    est = 0
                WHERE 
                    public.tm_curso.cur_id=?
            ";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1,$cur_id);
            $stmt->execute();
            return $resultado = $stmt->fetchAll();
        }
        public function getCursos(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "
                    SELECT 
                        public.tm_categoria.cat_id,
                        public.tm_categoria.cat_nombre,
                        public.tm_curso.cur_id,
                        public.tm_curso.cur_nombre,
                        public.tm_curso.cur_descrip,
                        public.tm_curso.cur_fechini,
                        public.tm_curso.cur_fechfin,
                        public.tm_curso.cur_img,
                        public.tm_instructor.inst_id,
                        public.tm_instructor.inst_nombre
                    FROM 
                        public.tm_curso 
                    INNER JOIN 
                        public.tm_categoria ON public.tm_categoria.cat_id =  public.tm_curso.cat_id
                    INNER JOIN
                        public.tm_instructor ON public.tm_instructor.inst_id =  public.tm_curso.inst_id
                    WHERE 
                        public.tm_curso.est=1
            ";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            return $resultado = $stmt->fetchAll();
        }
        public function getCursoId($cur_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "
                 SELECT 
                    public.tm_categoria.cat_id,
                    public.tm_categoria.cat_nombre,
                    public.tm_curso.cur_id,
                    public.tm_curso.cur_nombre,
                    public.tm_curso.cur_descrip,
                    public.tm_curso.cur_fechini,
                    public.tm_curso.cur_fechfin,
                    public.tm_curso.cur_img,
                    public.tm_instructor.inst_id,
                    public.tm_instructor.inst_nombre
                FROM 
                    public.tm_curso 
                INNER JOIN 
                    public.tm_categoria ON public.tm_categoria.cat_id =  public.tm_curso.cat_id
                INNER JOIN
                    public.tm_instructor ON public.tm_instructor.inst_id =  public.tm_curso.inst_id
                WHERE 
                    public.tm_curso.est=1 AND public.tm_curso.cur_id=?
            ";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1,$cur_id);
            $stmt->execute();
            return $resultado = $stmt->fetchAll();
        }
        //TODO fUNCION PARA ACTUALIZAR IMAGEN
        public function updateImgCurso($cur_id, $cur_img) {
            $conectar = parent::conexion();
            parent::set_names();

            require_once("Curso.php");
            $curx = new Curso();
            $cur_img = '';
            if ($_FILES["cur_img"]["name"]!=''){
                $cur_img = $curx->upload_file();
            }
        
            $sql = "UPDATE public.tm_curso SET cur_img=? WHERE cur_id=?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $cur_img);
            $stmt->bindValue(2, $cur_id);
            $stmt->execute();
        }
        
        //TODO fUNCION PARA SUBIR ARCHIVO
        public function upload_file(){
            if(isset($_FILES["cur_img"])){
                $extension = explode('.', $_FILES['cur_img']['name']);//extrae el .png
                $new_name = rand() . '.' . $extension[1];//Crea un nombre randon
                $destination = '../public/' . $new_name;//Ve el destino
                move_uploaded_file($_FILES['cur_img']['tmp_name'], $destination);//Lo guarda en el destino
                return "../../public/".$new_name;//lo retorna
            }
        }
    }
?>    