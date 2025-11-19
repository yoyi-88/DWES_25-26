<?php
    /*
        ejemplo 5.3: conexión a base de datos PDO
    */
    
    // Variables de conexión, esas variables normalmente se definen
    // como constantes, pues los valores no van a variar en la ejecución

    $ip = '127.0.0.1:3306';
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $bd = 'fp';

    try {
        // Establecemos la conexión
        $pdo = new PDO("mysql:host=$server;dbname=$bd", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Establecemos coomando sql
        $sql = "select * from alumnos";

        // Ejecutamos comando sql y devuelve el resultado
        // objeto de la clase poststatement
        $stmt = $pdo->query($sql);

        // muestro los datos
        while ($fila = $stmt->fetch()) {
        echo $fila['id'] . '-' . $fila['nombre'] . ' ' . $fila['apellidos'] . '<br>';
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();

    }
    
    // Cerrar conexión
    $pdo = null;


?>