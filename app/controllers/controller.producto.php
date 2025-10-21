<?php
include_once "./app/models/model.producto.php";
include_once "./app/models/model.marca.php";
include_once "./app/views/view.producto.php";

class ProductoController{
    private $model;
    private $modelMARCA;
    private $view;

    function __construct($res){
        $this-> view = new ProductoView($res->usuario);
        $this-> model= new ProductoModel();
        $this-> modelMARCA= new MarcaModel();
    }

    function mostrarTodo() {

        $productos = $this->model->ObtenerProductos();
        $marca = $this->modelMARCA->ObtenerMarcas();

        $this->view->mostrarTodo($productos, $marca);


    }

    function mostrar($id) {
        $producto = $this->model->obtenerProductoPorId($id);

        $this->view->mostrarProductoId($producto);


    }


  
    function añadirProductos() {
    
        $marcaproducto = $_POST['marca_producto'];
        $tipoproducto = $_POST['tipo_producto'];
        $modelo = $_POST['modelo'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
    
        $id = $this->model->insertoProductos($marcaproducto, $tipoproducto, $modelo, $descripcion, $precio);
        if ($id) {
            header('Location:' . BASE_URL . 'productos');
         die();////////////////////////////////////////////////////////////////
        } else {
            header('Location:' . BASE_URL . 'productos');
        }

    }

    function removerProducto($id) {
        $this->model->eliminarProducto($id);
        header('Location:' . BASE_URL . 'productos');
    }

    function mostrarFormModificarProducto($id) {
    
        $idproducto = $this->model->obtenerIDproducto($id);

        $this->view->modificarFormProducto($idproducto);

       
    }
    
    function modificarProducto() {
        $id = $_POST['idproducto'];
        $categoria = $_POST['tipo-productoNuevo'];
        $modelo = $_POST['modeloNuevo'];
        $descripcion = $_POST['descripcionNueva'];
        $precio = $_POST['precioNuevo'];
    
        $this->model->cambioValoresProducto($id, $categoria, $modelo, $descripcion, $precio);
        header('Location:' . BASE_URL . 'productos');
    }



    

    
}
?>