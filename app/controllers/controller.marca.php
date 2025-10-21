<?php
require_once "./app/models/model.marca.php";
require_once "./app/views/view.marca.php";



class MarcaController{

    private $model;
    private $view;


       public function __construct($res){
        $this-> model = new MarcaModel;
        $this-> view = new MarcaView($res->usuario);
    }

    function mostrarMarcas() {
       
        $marcas = $this->model->ObtenerMarcas();

        $this->view->mostrar($marcas);
     
    }



    function productosPorMarca($nombre_marca) {

        $this->view->ProductosPorMarca($nombre_marca);
    
        $productos = $this->model->obtenerProductosPorMarca($nombre_marca);
    
        if (!empty($productos)) {
            $this->view->recorridoPPM($productos);
     
        } else {
            $this->view->error("No hay productos disponibles para esta marca");
        }
    
    }

    
function añadirMarcas() {


    $nombre = $_POST['nombre'];
    $importador = $_POST['importador'];
    $paisorigen = $_POST['pais_origen'];

    if ($this->model->existeMarca($nombre)) {
        $this->view->errorMarcaDuplicada($nombre);
    } else {
        $id =$this->model-> insertoMarcas($nombre, $importador, $paisorigen);

        if ($id) {
            header('Location:'. BASE_URL . 'marcas');
        } else {
            $this->view->errorInsertarMarca();
        }
    }

}

function removerMarca($nombre_marca) {
    $this->model->eliminarMarca($nombre_marca);
    header('Location:'. BASE_URL . 'marcas');
}

function modificarMarca() {
    $id = $_POST['idmarca'];
    $importador = $_POST['importador-nuevo'];
    $paisOrigen = $_POST['pais_origen-nuevo'];

    $this->model->cambioValoresMarca($id, $importador, $paisOrigen);
    header('Location:'. BASE_URL . 'marcas');
}

function mostrarFormModificarMarca($id) {
    $idmarca =$this->model-> obtenerIDmarca($id);

    $this->view-> mostrarModificarMarca($idmarca);
  
}

  
}
?>