<?php

class ViewInicio{
    public $usuario = null;

    public function __construct($usuario) {
        $this->usuario = $usuario;
    }

    function inicio(){
      require_once "templates/inicio.phtml";
    }
}