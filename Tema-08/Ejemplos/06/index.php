<?php
/*
    Ejemplo 06
    Descripcion: stat()

*/

// Abro el archivo para escritura
$archivo = fopen("archivo.txt", "w");

// Escribo algo en el archivo
fwrite($archivo, "Hola, este es un ejemplo de uso de stat().\n");

// nueva linea
fwrite($archivo, "Esta es la segunda línea del archivo.\n");

// nueva linea
fwrite($archivo, "Y esta es la tercera línea del archivo.\n");

$datos = stat("archivo.txt");

// imprimo la información del archivo
print_r($datos);

fclose($archivo);





?>