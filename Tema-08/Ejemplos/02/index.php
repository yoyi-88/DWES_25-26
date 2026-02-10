<?php
/*
    Ejemplo 02: uso de la función file_get_contents() para leer el contenido de un archivo y file_put_contents() para escribir contenido en un archivo. Estas funciones son útiles para manejar archivos de texto de manera sencilla y eficiente.
    descripcion: En este ejemplo, se muestra cómo utilizar file_get_contents() para leer el contenido de un archivo de texto y file_put_contents() para escribir contenido en un archivo. Estas funciones son útiles para manejar archivos de texto de manera sencilla y eficiente.
*/

// Obtenemos el contenido del archivo "archivo.txt" si existe, de lo contrario se crea un nuevo archivo con un mensaje predeterminado
$contenido = file_get_contents("archivo.txt");

// Añadir nueva informacion
$contenido .= "Este es un nuevo contenido agregado al archivo.\n";

// Guardo el contenido con file.put_contents(), si el archivo no existe se crea, si existe se sobrescribe
file_put_contents("archivo.txt", $contenido);


?>