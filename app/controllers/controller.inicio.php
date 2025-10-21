<?php
require_once "./app/views/view.inicio.php";



class InicioController{

    private $view;


       public function __construct($res){
        $this-> view = new ViewInicio($res->usuario);
    }

function mostrarInicio(){
    $this->view->inicio();
}

  
}
?>