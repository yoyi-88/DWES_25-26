<?php
/* 
    Modelos para update peliculas que mostrara las peliculas actualizadas en la vista index.view.php
*/
$id = $_POST['id'];
$titulo = $_POST['titulo'];
$idioma = $_POST['idioma'];
$director = $_POST['director'];
$generos = explode(', ', $_POST['generos']);
$anio = $_POST['anio'];
$recaudado = $_POST['recaudado'];

$peliculas = get_tabla_peliculas();

$indice = get_indice_pelicula_por_id($peliculas, $id);

if ($indice !== null) {
    $peliculas[$indice] = [
        'id' => $id,
        'titulo' => $titulo,
        'idioma' => $idioma,
        'director' => $director,
        'generos' => $generos,
        'anio' => $anio,
        'recaudado' => $recaudado
    ];
} else {
    echo "Error al actualizar la película.";
    exit;
}




?>