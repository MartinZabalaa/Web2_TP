<?php
class ProductoView
{

    public $usuario = null;

    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }


    function mostrarTodo($productos, $marcas)
    {
        require_once "templates/header.phtml";

        require_once "templates/formProd.phtml";

        require_once "templates/footer.phtml";
    }

    function mostrarProductoId($producto)
    {

        require_once "templates/header.phtml";

    ?>
        <div class="product-details">
            <h2>Detalles del Producto</h2>
            <p><strong>Marca:</strong> <?php echo ($producto->nombre_marca); ?></p>
            <p><strong>Tipo:</strong> <?php echo ($producto->categoria); ?></p>
            <p><strong>Modelo:</strong> <?php echo ($producto->modelo); ?></p>
            <p><strong>Precio:</strong> <?php echo ("$" .$producto->precio); ?></p>
            <p><strong>Descripción:</strong> <?php echo ($producto->descripcion); ?></p>
        </div>
    <?php
        echo "<div><a href='" . BASE_URL . "productos' class='btn btn-success ml-2'>Regresar</a></div>";
        require_once "templates/footer.phtml";
    }

    function modificarFormProducto($idproducto)
    {
        require_once "templates/header.phtml";
        require_once "templates/formModProd.phtml";
        require_once "templates/footer.phtml";
    }


}
?>