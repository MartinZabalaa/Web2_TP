<?php
require_once "./config.php";

abstract class modelAbstract
{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8",
            MYSQL_USER,
            MYSQL_PASS
        );
        $this->_deployMarcas();
        $this->_deployProductos();
        /*$this->_deployUsuario();*/
    }

    private function _deployUsuario()
    {
        $query = $this->db->query("SHOW TABLES LIKE 'usuario'");
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END
              CREATE TABLE `usuario` (
              `id_login` int(11) NOT NULL AUTO_INCREMENT,
              `nombre` varchar(250) NOT NULL,
              `contraseña` char(60) NOT NULL,
              PRIMARY KEY (`id_login`),
              UNIQUE KEY `nombre` (`nombre`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
END;
            $this->db->query($sql);
        }
    }

    private function _deployProductos()
    {
        $query = $this->db->query("SHOW TABLES LIKE 'productos'");
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END
                  CREATE TABLE `productos` (
                  `id_productos` int(11) NOT NULL AUTO_INCREMENT,
                  `marca_producto` varchar(100) NOT NULL,
                  `tipo_producto` varchar(100) NOT NULL,
                  `modelo` varchar(100) NOT NULL,
                  `color` varchar(100) NOT NULL,
                  `descripcion_producto` TEXT NOT NULL,
                  `precio` int(20) NOT NULL,
                  PRIMARY KEY (`id_productos`),
                  CONSTRAINT `marca_marca_producto_productos` FOREIGN KEY (`marca_producto`) REFERENCES `marca` (`nombre_marca`) ON DELETE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    END;
            $this->db->query($sql);
        }
    }

    private function _deployMarcas()
    {
        $query = $this->db->query("SHOW TABLES LIKE 'marcas'");
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END
                      CREATE TABLE `marca` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `nombre_marca` varchar(100) NOT NULL,
                      `importador` varchar(100) NOT NULL,
                      `pais_origen` varchar(100) NOT NULL,
                      PRIMARY KEY (`id`),
                      UNIQUE KEY `nombre_marca` (`nombre_marca`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        END;
            $this->db->query($sql);
        }
    }
}
