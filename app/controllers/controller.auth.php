<?php
require_once "./app/models/model.usuarios.php";
require_once "./app/views/view.auth.php";

class AutenticacionController{
    private $model;
    private $view;


    function __construct(){
        $this->model = new UsuariosModel;
        $this->view = new AutenticacionView;
    }

    function mostrarLogin(){

        $this->view->mostrar();
    }

    public function login(){
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->mostrar('Falta completar el usuario');
        }
        if (!isset($_POST['contraseña']) || empty($_POST['contraseña'])) {
            return $this->view->mostrar('Falta completar la contraseña');
        }

        $nombre = $_POST['nombre'];
        $contraseña= $_POST['contraseña'];

        $usuarioBD =  $this->model->ObtenerUsuario($nombre);


        if ($usuarioBD && password_verify($contraseña,$usuarioBD->contraseña)) {

            session_start();
            $_SESSION['ID_USER'] = $usuarioBD->ID_Usuario;
            $_SESSION['NOMBRE_USER'] = $usuarioBD->nombre;
            $_SESSION['LAST_ACTIVITY'] = time();

            header('Location:' . BASE_URL . 'inicio');
        }

        else {
            return $this->view->mostrar('Credenciales incorrectas');
            exit(); // Detenemos el flujo para evitar que se siga ejecutando
        }
        
    }

    public function desloguearse(){
        session_start();
        session_destroy();

        header('Location:' . BASE_URL . 'inicio');
    }
}

?>
