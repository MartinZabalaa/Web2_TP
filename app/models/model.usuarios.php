<?php
require_once './app/models/abstract.model.php';

class UsuariosModel extends modelAbstract{

    protected $db;

    public function __construct() {
        parent::__construct();
     }
    
    

    function ObtenerUsuario($nombre){
        $query = $this->db->prepare("SELECT * FROM usuario WHERE nombre = ?");
        $query->execute([$nombre]);
    
        return $query->fetch(PDO::FETCH_OBJ); 
    }
}
?>