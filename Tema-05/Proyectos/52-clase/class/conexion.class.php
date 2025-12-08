<?php

/*
    clase: class_conexion
    descripción:  permite conectar con la base  de  datos gesbank, a partir de  las constantes
    de configuraciíon de la base de datos definidas en configDB.php
        - DB_HOST
        - DB_USER
        - DB_PASS
        - DB_NAME
        
*/

class class_conexion {
    
    public $pdo;

    public function __construct() {
        
        // estructura try catch
        try {

            // definir el dsn o nombre de la fuente de datos
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";


           // definir el array de opciones para la conexión PDO
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            // crear la instancia de la conexión PDO
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);


        } catch (PDOException $e) {

            // capturo el error de conexión
            include 'views/partials/errorDB.partial.php';

            // Cerrar conexión
            $this->pdo = null;

            // paro la ejecución 
            exit();


        }
    }
}

?>