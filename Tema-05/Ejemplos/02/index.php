<?php
    /*
        ejemplo 5.1: conexión a base de datos mysql mediante la clase mysqli
    */
    
    // Variables de conexión, esas variables normalmente se definen
    // como constantes, pues los valores no van a variar en la ejecución

    $ip = '127.0.0.1:3306';
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $bd = 'fp';

    // Establecemos la conexión
    $conexion = new mysqli($server, $user, $pass, $bd);

    // verificar conexión. Si connect error es diferente a 0 significa que existe un error
    if ($conexion->connect_error) {
        die('ERROR de conexión' . $conexion->connect_error);
    }

    echo 'Conectado con éxito <br>';

    // Ejecutar consulta a la tabla alumnos
    $sql = 'select * from alumnos';

    // Ejecuto la setencia sql y devuelve un objeto de la clase mysqli_result
    $resultado = $conexion->query($sql);

    // Mostrar resultados
    while ($fila = $resultado->fetch_assoc()) {
        echo $fila['id'] . '-' . $fila['nombre'] . ' ' . $fila['apellidos'] . '<br>';
    }

    // Cerrar conexión
    $conexion->close();

?>