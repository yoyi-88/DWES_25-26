<?php
/*
    Ordena segun el criterio seleccionado en index.view.php
*/


$busqueda = $_GET['busqueda'] ?? null;

$articulos = get_tabla_articulos();

if($busqueda) {

    $aux = [];

    foreach($articulos as $articulo) {
        if(array_search($busqueda, $articulo) != false) {
            $aux[] = $articulo; 
        }
    }


}

$articulos = $aux;




?>