<?php
/*
Ejemplo 3.13. Uso de la función array_keys
*/

$colores = array(
    "rojo" => "asd",
    "verde" => "sdf",
    "azul" => "sdf"
);

$claves = array_keys($colores);
echo $claves;

?>