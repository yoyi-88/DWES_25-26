<?php
    /*
        ejemplo: 7.5
        descripción: crear una cookie con tiempo de expiracion
    */

    // Datos para la cookie
    $nombre = "usuario";
    $valor = "Juan Pérez";

    // Fecha expiracion: 1 hora
    $expiracion = time() + 3600;

    // Creamos cookie
    setcookie('nombre', $valor, $expiracion);
    setcookie('apellidos', 'garcia lopez', time() + 3600);


    echo "Cookie '$nombre' creada con valor '$valor' y expiración en 1 hora.";




?>