<?php

function middlewaresesion($res){
    session_start();
    if (isset($_SESSION['ID_USER'])) {
        $res->usuario = new stdClass();
        $res->usuario->ID_Usuario = $_SESSION['ID_USER'];
        $res->usuario->nombre = $_SESSION['NOMBRE_USER'];
        return;
    } 
}

?>