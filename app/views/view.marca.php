<?php
class MarcaView
{


    public $usuario = null;

    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }


    function mostrar($marcas)
    {

        require_once "templates/header.phtml";
        require_once "templates/formMarcas.phtml";
        require_once "templates/footer.phtml";
    }

    function ProductosPorMarca($nombre)
    {
        require_once "templates/header.phtml";

        echo "<h2>Productos de la marca: $nombre</h2>";
    }


    function recorridoPPM($productos)
    {
        echo "<ul class='list-group'>";
        foreach ($productos as $producto) {
            echo "
                <li class='list-group-item'>
                    <b> Modelo: </b> {$producto->modelo} | <b> Categoria: </b> {$producto->categoria} | <b> Descripcion: </b> {$producto->descripcion} | <b> Precio: </b> {$producto->precio}
                </li>";
        }
        echo "<div><a href='" . BASE_URL . "marcas' class='btn btn-success ml-2'>Regresar</a></div>";
        echo "</ul>";

        require_once "templates/footer.phtml";
    }

 
    function mostrarModificarMarca($idmarca)
    {
        require_once "templates/header.phtml";
        require_once "templates/formModMarca.phtml";
        require_once "templates/footer.phtml";

    }


    //ERRORES
    function error($error){
        echo "<h2>ERROR: $error</h2>";
    }

    function errorInsertarMarca()
    {
        echo "
        <div class='alert alert-danger'>
            Error: No se pudo insertar la nueva marca correctamente.
            <a href='" . BASE_URL . "marcas' class='btn btn-primary ml-2'>Regresar</a>
        </div>
    ";
    }

    function errorMarcaDuplicada($nombre)
    {
        echo "
        <div class='alert alert-danger'>
            Error: La marca '$nombre' ya existe. No se puede agregar una marca duplicada.
            <a href='" . BASE_URL . "marcas' class='btn btn-success ml-2'>Regresar</a>
        </div>
    ";
    }




}
?>