<?php
/*
    Ejemplo 07
    Descripcion: 
        Operaciones básicas con archivo
        - copiar
        - eliminar
        -renombrar
        -mover

        Operaciones básicas con directorio
        - renombrar

*/
// Copiar archivo 'archivo.txt' a la carpeta files con el nombre 'archivo_copia.txt'
copy("archivo.txt", "files/archivo_copia.txt");

// Renombrar el archivo 'archivo_copia.txt' a 'archivo_renombrado.txt'
rename("files/archivo_copia.txt", "files/archivo_renombrado.txt");

// Mover el archivo 'archivo_renombrado.txt' a la carpeta 'datos'
rename("files/archivo_renombrado.txt", "datos/archivo_renombrado.txt");

// Hacer una nueva versión del archivo 'archivo.txt' con el nombre 'archivo_nuevo.txt'
copy("archivo.txt", "archivo_nuevo.txt");

// Eliminar el archivo 'archivo_nuevo.txt'
unlink("archivo_nuevo.txt");



?>