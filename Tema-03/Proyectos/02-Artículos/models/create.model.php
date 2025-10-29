<?php
/*
    Añade el libro definido con new.php a index.view.php
*/


$articulos = get_tabla_articulos();

// Creamos las variables
$id = count($articulos) + 1 ?? null;
$descripcion = $_POST["descripcion"] ?? null;
$modelo = $_POST["modelo"] ?? null;
$categoria_id = $_POST["categoria_id"] ?? null;
$unidades = $_POST["unidades"] ?? null;
$precio = $_POST["precio"] ?? null;

$nuevoArticulo = [
    "id" => $id,
    'descripcion' => $descripcion,   
    'modelo'=> $modelo,
    'categoria_id'=> $categoria_id,
    'unidades'=> $unidades,
    'precio' => (float)$precio
];



$articulos[] = $nuevoArticulo;


?>