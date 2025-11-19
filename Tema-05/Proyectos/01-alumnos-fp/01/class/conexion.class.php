<?php
    /*
        clase: class_conexion
        descripción: permite conectar con la base de datos fp, a partir de los parámetros de conexión:
            - server
            - user
            - pass
            - base_datos
    */

    class class_conexion {
        public $server;
        public $user;
        public $pass;
        public $database;
        public $mysqli;

        public function __construct(
            $server,
            $user,
            $pass,
            $database

        ) {
            $this->server=$server;
            $this->user=$user;
            $this->pass=$pass;
            $this->database=$database;

            // Habilitar las excepciones mysqli
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            // Estructura try catch
            try {
                // Realizo la conexión
                $this->mysqli = new mysqli(
                    $server,
                    $user,
                    $pass,
                    $database
                );

            } catch (mysqli_sql_exception $e) {
                
                echo 'ERROR DE BASE DE DATOS' . '<br>';
                echo 'Mensaje: ' . $e->getMessage() . '<br>';
                echo 'Código de error: ' . $e->getCode() . '<br>';
                echo 'Fichero: ' . $e->getFile() . '<br>';
                echo 'Línea: ' . $e->getLine() . '<br>';

                // Paro la ejecución
                exit();

            }
        }
        
    }

    
?>