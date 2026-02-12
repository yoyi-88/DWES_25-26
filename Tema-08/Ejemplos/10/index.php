<?php
/*
    Ejemplo 10
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
// Abrir directorio files y mostrar su contenido
$dir = scandir("files/pdf", SCANDIR_SORT_ASCENDING);
echo "<h2>Contenido del directorio files/pdf:</h2>";
foreach ($dir as $item) {
    echo $item . "<br>";
}

print_r($dir);
?>