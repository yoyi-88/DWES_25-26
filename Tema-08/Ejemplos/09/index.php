<?php
/*
    Ejemplo 08
    Descripcion: 
        Controlar si es un archivo o un directorio

        Operaciones básicas archivo y directorio
        - chdir()
        - chroot()
        - closedir()
        - dir()
        - getcwd(): directorio actual ruta absoluta
        - opendir()
        - readdir()
        - rewinddir()
        - scandir()

*/
// Cambiar el directorio actual a files/pdf
chdir("files/pdf");
echo "Directorio actual: " . getcwd() . "<br>";

// Mostrar contenido de un directorio
$dir = opendir(".");
echo "Contenido del directorio actual:<br>";
while (($archivo = readdir($dir)) !== false) {
    // verificar si es un archivo o un directorio
    if (is_file($archivo)) {
        echo "Archivo: " . $archivo . "<br>";
    } elseif (is_dir($archivo)) {
        echo "Directorio: " . $archivo . "<br>";
    } 
}

// Cerrar el directorio
closedir($dir);




?>