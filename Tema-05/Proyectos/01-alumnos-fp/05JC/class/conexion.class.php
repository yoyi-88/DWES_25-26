<?php

/*
    clase: class_conexion
    descripción:  permite conectar con la base  de  datos fp, a partir de  las constantes
    de configuraciíon de la base de datos definidas en configDB.php
        - DB_HOST
        - DB_USER
        - DB_PASS
        - DB_NAME
        
*/

class class_conexion {
    
    public $mysqli;

    public function __construct() {
        
        // habilitar las excepciones mysqli
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        // estructura try catch
        try {

            // realizo la conexión
            $this->mysqli = new mysqli(
                DB_HOST, 
                DB_USER, 
                DB_PASS,    
                DB_NAME
            );

        } catch (mysqli_sql_exception $e) {

            // capturo el error de conexión
            include 'views/error_db.view.php';

            // paro la ejecución 
            exit();


        }
    }
}

?>