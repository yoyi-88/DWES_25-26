<?php
/*
    Ejemplo 19
    Descripcion: Descomprimir archivo zip en carpeta del servidor
*/

// Nombre del archivo zip a descomprimir
$archivo_Zip = 'pdf.zip';

// crear instancia de la clase ZipArchive
$zip = new ZipArchive;

// Abrir archivo zip
if ($zip->open($archivo_Zip) === FALSE) {
    die("Error al abrir el archivo zip");
}

// Extraer el contenido del archivo zip a la carpeta 'pdf'

$zip->extractTo('pdf');

// Cerrar el archivo zip
$zip->close();

echo "Archivo zip descomprimido correctamente";

?>