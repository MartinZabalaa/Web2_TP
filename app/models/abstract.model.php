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
        $this->_deployUsuario();
    }

    private function _deployUsuario()
    {
        $query = $this->db->query("SHOW TABLES LIKE 'usuario'");
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END
              CREATE TABLE `usuario` (
              `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT,
              `nombre` varchar(250) NOT NULL,
              `contraseña` char(60) NOT NULL,
              PRIMARY KEY (`ID_Usuario`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
END;
            $this->db->query($sql);

            // --- INSERCIÓN DEL ADMINISTRADOR ---
        $admin_password_hash = password_hash('admin', PASSWORD_DEFAULT);
        $admin_sql = $this->db->prepare("INSERT INTO `usuario` (`nombre`, `contraseña`) VALUES (?, ?)");
        $admin_sql->execute(['webadmin', $admin_password_hash]);
        // -----------------------------------
        }
    }

    private function _deployProductos()
    {
        $query = $this->db->query("SHOW TABLES LIKE 'productos'");
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END
                  CREATE TABLE `productos` (
                  `ID_Productos` int(11) NOT NULL AUTO_INCREMENT,
                  `nombre_marca` varchar(100) NOT NULL,
                  `categoria` varchar(100) NOT NULL,
                  `modelo` varchar(100) NOT NULL,
                  `descripcion` TEXT NOT NULL,
                  `precio` int(20) NOT NULL,
                  PRIMARY KEY (`ID_Productos`),
                  CONSTRAINT `marcas_nombre_marca_productos` FOREIGN KEY (`nombre_marca`) REFERENCES `marcas` (`nombre`) ON DELETE CASCADE
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
                      CREATE TABLE `marcas` (
                      `ID_Marcas` int(11) NOT NULL AUTO_INCREMENT,
                      `nombre` varchar(100) NOT NULL,
                      `importador` varchar(100) NOT NULL,
                      `pais_origen` varchar(100) NOT NULL,
                      PRIMARY KEY (`ID_Marcas`),
                      UNIQUE KEY `nombre` (`nombre`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        END;
            $this->db->query($sql);
        }
    }
}
