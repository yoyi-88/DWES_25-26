<?php
/*
    Actualiza el articulo en el index.view.php
*/


$id_editar = $_GET["id"];



$descripcion = $_POST["descripcion"] ?? null;
$modelo = $_POST["modelo"] ?? null;
$categoria_id = $_POST["categoria_id"] ?? null;
$unidades = $_POST["unidades"] ?? null;
$precio = $_POST["precio"] ?? null;

$articulos = get_tabla_articulos();

$indice = get_indice_articulo_por_id($articulos, $id_editar);

$update_articulos = [
    'id' => $id_editar,
    'descripcion'=> $descripcion,
    'modelo'=> $modelo,
    'categoria_id'=> $categoria_id,
    'unidades'=> $unidades,
    'precio'=> (float)$precio
];



$articulos[$indice] = $update_articulos;






?>