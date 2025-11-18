<?php
    /*
        ejemplo 5.1: conexión a base de datos mysql 
    */
    
    // Variables de conexión, esas variables normalmente se definen
    // como constantes, pues los valores no van a variar en la ejecución

    $ip = '127.0.0.1:3306';
    $server = 'localhost';
    $user = 'root';
    $pass = null;
    $bd = 'fp';

    // Establecemos la conexión
    $conexion = mysqli_connect($server, $user, $pass, $bd);

    // verificar conexión
    if (!$conexion) {
        die('ERROR de conexión' . mysqli_connect_error());
    }

    echo 'Conectado con éxito <br>';

    // Ejecutar consulta a la tabla alumnos
    $sql = 'select * from alumnos';
    $resultado = mysqli_query($conexion, $sql);

    // Mostrar resultados
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo $fila['id'] . '-' . $fila['nombre'] . ' ' . $fila['apellidos'] . '<br>';
    }

    // Cerrar conexión
    mysqli_close($conexion);

?>