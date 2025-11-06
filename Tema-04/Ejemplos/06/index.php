<?php
    /*
        Ejemplo 4.6: Uso de atributos y métodos estáticos en una clase.
    */
    
    // CONTROLADOR: Todos los includes
    // 1. Incluimos la clase estatica
    include_once "class/estatica.class.php";


    // Crear una instancia de la clase Estatica
    $pelicula = new Class_pelicula();

    // Mostrar el país usando el método no estático (esto genera un error)
    echo "Usando método no estático: " . $pelicula->mostrarPais() . "<br>";

    // Mostrar el país usando el método estático
    echo "Usando método estático: " . Class_pelicula::mostrarPaisEstatico();

?>