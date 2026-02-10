<?php
/*
    Ejemplo 03:
    descripcion: uso de file() para leer un archivo linea por linea.  

    */

// leemos el archivo y lo guardamos en un array
$archivo = file("archivo.txt");

// Mostramos el contenido del array
foreach ($archivo as $linea) {
    echo $linea . "<br>";
}


?>