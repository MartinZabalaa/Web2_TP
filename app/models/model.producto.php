<?php
require_once './app/models/abstract.model.php';

class ProductoModel extends modelAbstract{

    protected $db;

    public function __construct() {
        parent::__construct();
     }
    
    

    public function ObtenerProductos($orderBy = false) {

        $sql = 'SELECT * FROM productos';

        if($orderBy){
            switch ($orderBy) {
                case 'precioASC':
                    $sql .= ' ORDER BY precio ASC';
                    break;
                case 'precioDESC':
                        $sql .= ' ORDER BY precio DESC';
                    break;
        
            }
          
        }

        $query = $this->db->prepare($sql);
        $query->execute();
        

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function ObtenerPrecio() {

        $query = $this->db->prepare('SELECT * FROM productos WHERE precio');
        $query->execute();
        

        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    function obtenerProductoPorId($id) {
        $query = $this->db->prepare("SELECT * FROM productos WHERE 	ID_Productos  = ?");
        $query->execute([$id]);
    
        return $query->fetch(PDO::FETCH_OBJ); 
    }

    function insertoProductos($marcaproducto, $tipoproducto, $modelo, $descripcion, $precio) {


        $query = $this->db->prepare('INSERT INTO productos(nombre_marca, categoria, modelo, descripcion, precio) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$marcaproducto, $tipoproducto, $modelo, $descripcion, $precio]);
    
        return $this->db->lastInsertId();
    }

    
function eliminarProducto($id) {

    $query = $this->db->prepare("DELETE FROM productos WHERE id_productos = ?");
    $query->execute([$id]);
}


function obtenerIDproducto($id){

    $query = $this->db->prepare("SELECT * FROM productos WHERE id_productos = ?");
    $query->execute([$id]);
    $idproducto = $query->fetch(PDO::FETCH_OBJ);
    return  $idproducto;
}

function cambioValoresProducto($id,  $categoria, $modelo, $descripcion, $precio ){

    $query = $this->db->prepare('UPDATE productos SET categoria = ?, modelo = ?, descripcion = ?, precio = ?  WHERE ID_Productos = ?');
    $query->execute([$categoria, $modelo, $descripcion, $precio, $id]);
}


    
    
}

?>