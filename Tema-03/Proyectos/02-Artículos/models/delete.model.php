<?php
/*
    Añade el libro definido con new.php a index.view.php
*/


$id_eliminar = $_GET["id"];

$articulos = get_tabla_articulos();

$indice = get_indice_articulo_por_id($articulos, $id_eliminar);

if ($indice !== null) {
    unset($articulos[$indice]);

    $articulos = array_values($articulos);
}

?>