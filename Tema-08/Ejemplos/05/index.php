<?php
/*
    Ejemplo 05
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
echo "Tamaño del archivo: " . $datos['size'] . " bytes<br>";
echo "Última modificación: " . date("Y-m-d H:i:s", $datos['mtime']) . "<br>";
echo "Último acceso: " . date("Y-m-d H:i:s", $datos['atime']) . "<br>";
echo "Último cambio: " . date("Y-m-d H:i:s", $datos['ctime']) . "<br>";
echo "Permisos: " . substr(sprintf('%o', $datos['mode']), -4) . "<br>";
echo "Número de enlaces: " . $datos['nlink'] . "<br>";
echo "ID del propietario: " . $datos['uid'] . "<br>";
echo "ID del grupo: " . $datos['gid'] . "<br>";
echo "Dispositivo: " . $datos['dev'] . "<br>";
echo "Número de inodo: " . $datos['ino'] . "<br>";
echo "Tipo de archivo: " . filetype("archivo.txt") . "<br>";

fclose($archivo);




?>