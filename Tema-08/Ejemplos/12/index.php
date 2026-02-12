<?php
/*
    Ejemplo 12
    Descripcion: 
        Funciones de directorios en PHP
        - chdir()
        - getcwd()
        - mkdir()
        - rmdir()
        - glob()
        - dirname()
        - basename()
        - is_dir()
        - pathinfo()
        - unlink()
*/
//  //Mostrar ruta completa del directorio actual
// echo "Directorio actual: " . getcwd() . "<br>";

// // Nombre del directorio acual
// echo "Nombre del directorio actual: " . basename(getcwd()) . "<br>";

// // Directorio padre del directorio actual
// echo "Directorio padre: " . dirname(getcwd()) . "<br>";

// // Crear un nuevio directorio
// // mkdir("csv_files");
// echo "Directorio csv_files creado.<br>";

// // Cambiar al nuevo directorio
// chdir("csv_files");

// // Nombre del directorio acual
// echo "Nombre del directorio actual: " . basename(getcwd()) . "<br>";

// // Vuelvo al directorio padre
// chdir("..");
// echo "Nombre del directorio actual: " . basename(getcwd()) . "<br>";

// // Eliminar el directorio creado
// rmdir("csv_files");
// echo "Directorio csv_files eliminado.<br>";

//Eliminar el directorio files
chdir("files/pdf/saga");
//Obtener todos los archivos del directorio
$files = glob("*");

// Eliminar cada archivo
foreach ($files as $file) {
    if(is_file($file)) {
        unlink($file);
        echo "Archivo $file eliminado.<br>";
    }else {
        rmdir($file);
        echo "Directorio $file eliminado.<br>";
    }
}

// Volver al directorio padre y eliminar el contenido de pdf
chdir("..");
$files = glob("*");
foreach ($files as $file) {
    if(is_file($file)) {
        unlink($file);
        echo "Archivo $file eliminado.<br>";
    }else {
        rmdir($file);
        echo "Directorio $file eliminado.<br>";
    }
}

chdir("..");


// Eliminar el directorio files
rmdir("files");
echo "Directorio files eliminado.<br>";



?>