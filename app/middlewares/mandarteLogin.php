<?php
function verificar($res){
    if ($res->usuario) {
        return;
    }else{
        header('Location: ' . BASE_URL .'mostrarlogin');
        die();
    }
}
    

?>