<?php
/*
    Ejemplo 8.1: Crear archivo de texto plano
    Descripcion: Abrir, escribir y cerrar un archivo de texto plano utilizando la función fopen(), fwrite() y fclose() respectivamente.
*/

// Abrir el archivo en modo de escritura (w)
$archivo = fopen("archivo.txt", "w");

// Verificar si el archivo se abrió correctamente
if ($archivo) {
    // Escribir contenido en el archivo
    $contenido = "Hola, este es un archivo de texto plano.\n";
    fwrite($archivo, $contenido);

    // Escribir más contenido
    $contenido2 = "Este archivo fue creado utilizando PHP.\n";
    fwrite($archivo, $contenido2);

    // Escribir contenido adicional
    $contenido3 = "¡PHP es genial para manejar archivos!\n";
    fwrite($archivo, $contenido3);

    // Cerrar el archivo
    fclose($archivo);
    echo "Archivo creado y contenido escrito exitosamente.";
} else {
    echo "Error al abrir el archivo.";
}


?>