<?php
/*
    A
*/


$id_editar = $_GET['id'] ?? null;

$articulos = get_tabla_articulos();

$indice = get_indice_articulo_por_id($articulos, $id_editar);

if ($indice !== null) {
    $articulo = $articulos[$indice];
} else {
    echo'Error, libro no encontrado';
    exit();
}


?>