<?php
/*
ejemplo 3.12: uso de la funciones para array
*/

$frutas = ["naranja", "manzana", "platano", "pera"];

echo "array original: \n";
print_r($frutas);

// Eliminar el platano del array
unset($frutas[2]);

// mostrar el array con foreach
foreach ($frutas as $fruta) {
    echo $fruta . "\n";
}


?>