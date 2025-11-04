<?php
/*
    Ordena segun el criterio seleccionado en index.view.php
*/


$campo = $_GET["campo"] ?? null;

$articulos = get_tabla_articulos();

if($campo) {
    $array_orden = array_column($articulos, $campo);

    array_multisort($array_orden, SORT_ASC, $articulos);
}







?>