<?php
/*
    Ejemplo 04
    Descripcion: uso de fgets() para leer un archivo linea por linea.

*/

$archivo = fopen("archivo.txt", "r");
if ($archivo) {
    while (($linea = fgets($archivo)) !== false) {
        echo $linea . "<br>";
    }
    fclose($archivo);
} else {
    echo "Error al abrir el archivo.";
}




?>