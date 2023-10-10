<?php

require "./clases/Conexion.php";

class Autenticacion extends Conexion{
    protected $correo;
    protected $password;

    #metodo que valida el inicio de usuario de los coach
    public function autenticarUsuario(){
        if(isset($_POST['email'], $_POST['password'])){
            $this->correo = $_POST['email'];
            $this->password = $_POST['password'];

            $pdo = $this->conectar();
            $query = $pdo->prepare("SELECT id, nombre, correo, password FROM coach WHERE correo = ? AND password = ?");
            $query->execute(["$this->correo","$this->password"]);

            $usuario = $query->fetch(PDO::FETCH_ASSOC);
            if(is_array($usuario)){
                //crear la sesion
                $_SESSION['nombre_usuario'] = $usuario['nombre'];
                
                //redireccionando a otra pagina
                header("location: ./home.php");
            }else{
                echo "<div class='alert alert-danger' role='alert'>
                    Credenciales Incorrectas
                </div>";
            }
        }

    }
    //metod para destruir la sesion
    public function cerrarSesion(){
        //validar que la persona haya dado click al boton de cerrar sesion
        if(isset($_POST['cerrar_sesion'])){
            //destruir sesion
            session_destroy();
            header("location: ./index.php");
        }
    }
}

?>