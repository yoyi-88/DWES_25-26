<?php
    /*
        ejemplo: 7.6
        descripción: mostrar los datos de una cookie
    */

    // Datos para la cookie
    $nombre = "usuario";
    $valor = "Juan Pérez";

    // Fecha expiracion: 1 hora
    $expiracion = time() + 3600;

    // Creamos cookie
    setcookie($nombre, $valor, $expiracion);
    setcookie('apellidos', 'garcia lopez', time() + 3600);


    echo "Cookie '$nombre' creada con valor '$valor' y expiración en 1 hora.<br>";

    // Nombre de la cookie a mostrar
    $apellidos = "apellidos";
    
    if (isset($_COOKIE[$nombre])) {
        echo "Valor de la cookie '$nombre': " . $_COOKIE[$nombre] . "<br>";
    } else {
        echo "La cookie '$nombre' no está establecida.<br>";
    }

    if (isset($_COOKIE[$apellidos])) {
        echo "Valor de la cookie '$apellidos': " . $_COOKIE[$apellidos] . "<br>";
    } else {
        echo "La cookie '$apellidos' no está establecida.<br>";
    }




?>