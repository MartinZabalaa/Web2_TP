<?php
require_once './app/models/abstract.model.php';

class MarcaModel extends modelAbstract{

    protected $db;

    public function __construct() {
        parent::__construct();
     }
    

    function ObtenerMarcas() {
        $query = $this->db->prepare('SELECT * FROM marcas');
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function obtenerProductosPorMarca($nombre_marca) {
        $query = $this->db->prepare("SELECT * FROM productos WHERE 	nombre_marca = :nombre");
        $query->bindParam(':nombre', $nombre_marca);
        $query->execute();
    
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    
    function obtenerIDmarca($id){
        $query = $this->db->prepare("SELECT * FROM marcas WHERE ID_Marcas = ?");
        $query->execute([$id]);
        $idmarca = $query->fetch(PDO::FETCH_OBJ);
        return  $idmarca;
    }

    function insertoMarcas($nombre, $importador, $paisorigen) {
        $query = $this->db->prepare('INSERT INTO marcas(nombre, importador, pais_origen) VALUES (?, ?, ?)');
        $query->execute([$nombre, $importador, $paisorigen]);
    
        return $this->db->lastInsertId();
    }
    
    function existeMarca($nombre_marca) {
        $query = $this->db->prepare("SELECT COUNT(*) FROM marcas WHERE nombre = :nombre");
        $query->bindParam(':nombre', $nombre_marca);
        $query->execute();
    
        return $query->fetchColumn() > 0;
    }

    function eliminarMarca($nombre_marca) {
        
        $queryProductos = $this->db->prepare("DELETE FROM productos WHERE nombre_marca = ?");
        $queryProductos->execute([$nombre_marca]);
    
        $query =  $this->db->prepare("DELETE FROM marcas WHERE nombre = ?");
        $query->execute([$nombre_marca]);
    }
    
    function cambioValoresMarca($id, $importador, $paisOrigen){
        $query = $this->db->prepare('UPDATE marcas SET importador = ?, pais_origen = ? WHERE ID_Marcas = ?');
        $query->execute([$importador, $paisOrigen, $id]);
    }


}
?>