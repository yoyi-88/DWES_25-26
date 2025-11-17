<?php

/*
    Carga los datos necesarios para mostrr en un formulario editable los detalles de un artículo.
    Parámetro GET:
    -ID: artículo a editar
*/

// Obtengo id del artículo
$id = $_GET['id'] ?? null;

// Obtener el array de objetos de la clase artículos

// Creo objeto de la clase tabla_articulos
$tabla_articulos = new Class_tabla_articulos();

// Cargar los datos
$tabla_articulos->get_datos();


// Obtener los detalles del artículo mediante un objeto de la clase artículo

// Obtener el índice del array en el que se encuentra el objeto de la clase artículo
$indice = $tabla_articulos->get_indice_from_id($id);

// Obtener el objeto de la clase artículo
$articulo = $tabla_articulos->get_articulo_from_indice($indice);

// Cargar array de marcas 
$marcas = Class_tabla_articulos::get_marcas();

// Cargar array de categorias
$categorias = Class_tabla_articulos::get_Categorias();




?>