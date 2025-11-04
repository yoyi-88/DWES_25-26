<?php
/* 
    Modelo editar peliculas
*/

$id_eliminar = $_GET['id'];

$peliculas = get_tabla_peliculas();

$indice = get_indice_pelicula_por_id($peliculas, $id_eliminar);

if ($indice !== null) {
    unset($peliculas[$indice]);
} else {
    echo "Película no encontrada.";
    exit;
}

?>