<?php

/*
    Elimina un artículo de la tabla a partir de su id
    Parámetro GET:
    -ID: artículo a eliminar
*/

// Obtengo id del artículo
$id = $_GET['id'] ?? null;

// Obtener el array de objetos de la clase artículos

// Creo objeto de la clase tabla_articulos
$tabla_articulos = new Class_tabla_articulos();

// Cargar los datos
$tabla_articulos->get_datos();

// Obtener el índice del array en el que se encuentra el objeto de la clase artículo
$indice = $tabla_articulos->get_indice_from_id($id);

// Eliminar artículo del array mediante el método delete
$tabla_articulos->delete($indice);

// Obtener la tabla articulos
$articulos = $tabla_articulos->articulos;

// Cargar array de marcas 
$marcas = Class_tabla_articulos::get_marcas();

// Cargar array de categorias
$categorias = Class_tabla_articulos::get_Categorias();




?>