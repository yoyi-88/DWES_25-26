<?php
/* 
    
*/


$id = $_POST['id'];
$titulo = $_POST['titulo'];
$idioma = $_POST['idioma'];
$director = $_POST['director'];
$generos = explode(', ', $_POST['generos']);
$anio = $_POST['anio'];
$recaudado = $_POST['recaudado'];

$nueva_pelicula = [
    'id' => $id,
    'titulo' => $titulo,
    'idioma' => $idioma,
    'director' => $director,
    'generos' => $generos,
    'anio' => $anio,
    'recaudado' => $recaudado
];

$peliculas = get_tabla_peliculas();

if ($nueva_pelicula !== null) {
    $peliculas[] = $nueva_pelicula;
    
} else {
    echo "Error al añadir la película.";
    exit;
}

?>