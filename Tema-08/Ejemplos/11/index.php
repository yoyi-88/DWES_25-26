<?php
/*
    Ejemplo 11
    Descripcion: 
        uso funcion glob() para mostrar contenido de un directorio

*/
// Mostrar directorio actual
echo "Directorio actual: " . getcwd() . "<br>";

// Mostrar contenido del directorio files/pdf usando glob()
$archivos = glob("files/pdf/*");

echo "<h2>Contenido del directorio files/pdf:</h2>";
foreach ($archivos as $archivo) {
    if (is_file($archivo)) {
        echo "Archivo: " . basename($archivo) . "<br>";
    } elseif (is_dir($archivo)) {
        echo "Directorio: " . basename($archivo) . "<br>";
    }
}

?>