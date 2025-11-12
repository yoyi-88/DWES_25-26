<?php

/*
    Obtiene los detalles del formulario y añade nuevo artículo
*/

// Cargar los detalles del formulario

$id = $_POST['ID'] ?? null;
$descripcion = $_POST['descripcion'] ?? null;
$modelo = $_POST['modelo'] ?? null;
$marca = $_POST['narca'] ?? null;
$categorias = $_POST['categorias'] ?? [];
$unidades = $_POST['unidades'] ?? null;
$precio = $_POST['precio'] ?? null;


// Validación

// Creo un objeto de la clase artículos a partir de los detalles del formulario
$articulo = new Class_articulo(
    $id,
    $descripcion,
    $modelo,
    $marca,
    $categorias,
    $unidades,
    $precio
    
);

// Crear un objeto o instacia de la clase tabla_articulos
$tabla_articulos = new Class_tabla_articulos();

// Cargar los datos
$tabla_articulos->get_datos();

// Añade nuevo objeto a la tabla
$tabla_articulos->create($articulo);

// Obtener array de objetos de la clase artículos
$articulos = $tabla_articulos->get_articulos();

// obtener array marcas
$marcas = Class_tabla_articulos::get_marcas();

// Obtener array de categorias
$categorias = Class_tabla_articulos::get_Categorias();





?>