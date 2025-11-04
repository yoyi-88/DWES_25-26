<?php
/* 
    Modelo editar peliculas
*/

$id_editar = $_GET['id'];

$peliculas = get_tabla_peliculas();

$indice = get_indice_pelicula_por_id($peliculas, $id_editar);

if ($indice !== null) {
    $pelicula = $peliculas[$indice];
} else {
    echo "Película no encontrada.";
    exit;
}

?>