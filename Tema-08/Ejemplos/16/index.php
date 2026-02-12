<?php
/*
    Ejemplo 16
    Descripcion: Leer archivo csv con fgetcsv() y mostrar su contenido en una tabla html
        
*/
// Abrir el archivo csv para lectura
$archivo = fopen("csv/alumnos.csv", "rb");

// mostrar el contenido del archivo csv en una tabla html
echo "<table border='1'>";
while (($fila = fgetcsv($archivo, 0, ";", '"')) !== false) {
    echo "<tr>";
    foreach ($fila as $celda) {
        echo "<td>" . htmlspecialchars($celda) . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
// Cerrar el archivo
fclose($archivo);

// Mostrar mensaje de exito
echo "<p>Archivo csv leído correctamente.</p>";

?>