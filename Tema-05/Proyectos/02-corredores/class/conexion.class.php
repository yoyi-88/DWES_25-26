<?php
    /*
        Creación de conexión a base de datos
    */


    class class_conexion {
       public $mysqli;

       public function __construct() {
            
            // Habilitamos las excepciones mysql
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

           try {
                $this->mysqli = new mysqli(
                    DB_HOST,
                    DB_USER,
                    DB_PASS,
                    DB_NAME

                );

           } catch(mysqli_sql_exception $e) {

                include 'views/partials/errorDB.partial.php';

            exit();
           }


        }
    }

    




?>