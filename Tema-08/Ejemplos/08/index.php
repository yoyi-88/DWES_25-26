<?php
/*
    Ejemplo 08
    Descripcion: 
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
// Mostrar directorio actual
echo "Directorio actual: " . getcwd() . "<br>";

// Cambiar el directorio actual a 'files'
chdir("files");
echo "Directorio actual después de chdir: " . getcwd() . "<br>";

// Cambiar directorio padre
chdir("..");
echo "Directorio actual después de chdir a padre: " . getcwd() . "<br>";

// Cambiar el directorio actual a files/pdf
chdir("files/pdf");
echo "Directorio actual después de chdir a files/pdf: " . getcwd() . "<br>";

// Mostrar contenido de un directorio
$dir = opendir(".");
echo "Contenido del directorio actual:<br>";
while (($archivo = readdir($dir)) !== false) {
    echo $archivo . "<br>";
}

// Cerrar el directorio
closedir($dir);





?>