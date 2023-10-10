<?php
class Conexion{
    
    /**
     * PDO: objetos de datos de php / POO / sql server / oracle
     */

    public function conectar(){
        //gestion de errores
        try{
            $conectar = "mysql:host=localhost;dbname=practica_kodigo;charset=utf8";
            $opciones = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            $pdo = new PDO($conectar, "root", "", $opciones);
            return $pdo;

        }catch(PDOException $e){
            echo "Error de conexion: " .$e->getMessage();
            exit();
        }
    }
}

?>