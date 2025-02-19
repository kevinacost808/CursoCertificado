<?php
    /*inicializando la sesion del usuario*/
    session_start();
    class Conexion{
        protected $dbh;

        protected function conexion(){
            $contraseña = "kevin";
            $usuario = "postgres";
            $nombreBaseDeDatos = "Certificados";
            # Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto
            $rutaServidor = "localhost";
            $puerto = "5432";
            try{
                $conectar = $this->dbh = new PDO("pgsql:host=$rutaServidor;port=$puerto;dbname=$nombreBaseDeDatos", $usuario, $contraseña);
                return $conectar;
            }catch(Exception $e){
                print "¡Error BD!: " . $e->getMessage() ."<br/>";
                die();
            }    
        }

        public function set_names(){
            return $this->dbh->query("SET NAMES 'utf8'");
        }   

        public static function ruta(){
            return "http://192.168.56.1/PERSONAL_CursosCertificados/";
        }
    }
?>