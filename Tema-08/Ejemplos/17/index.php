<?php
/*
    Ejemplo 17
    Descripcion: Comprimir archivos con la clase ZipArchive

    Proceso:
    1. Crear un nuevo objeto ZipArchive
    2. Abrir un nuevo archivo zip con el metodo open()
    3. Agregar archivos al zip con el metodo addFile()
    4. Cerrar el zip con el metodo close()

    php.ini

    Habilitar la extensión zip en el archivo php.ini, descomentando la línea:
    extension=zip
        
*/

// Crear un nuevo objeto ZipArchive
$zip = new ZipArchive();

// Abrir un nuevo archivo zip
$nombre_zip = "archivos.zip";
if ($zip->open($nombre_zip, ZipArchive::CREATE) === TRUE) {
    // Abro la carpeta pdf y leo su contenido
    $carpeta = "pdf/";

    // Leo el contenido de la carpeta pdf con glob()
    $archivos = glob($carpeta . "/*.pdf");

    // Agregar archivos al zip
    foreach ($archivos as $archivo) {
        $zip->addFile($archivo, basename($archivo));
    }

    // Cerrar el zip
    $zip->close();
    echo "<p>Archivo zip creado correctamente.</p>";
} else {
    echo "<p>Error al crear el archivo zip.</p>";
}

?>