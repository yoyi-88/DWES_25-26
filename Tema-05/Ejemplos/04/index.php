<?php
    /*
        ejemplo 5.4:uso conexión a base de datos con PDO
    */
    
    // Variables de conexión, esas variables normalmente se definen
    // como constantes, pues los valores no van a variar en la ejecución

    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $bd = 'fp';

    try {
        $dsn = "mysql:host=$server;dbname=$bd;charset=utf8mb4";

        // Crear un objeto de la clase PDO
        // Conectamos con la base de datos fp
        $pdo = new PDO($dsn, $user, $pass);

        // Configuramos el modo de error de PDO a excepción
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
        echo 'Error de conexión' . $e->getMessage();
    }
    
?>