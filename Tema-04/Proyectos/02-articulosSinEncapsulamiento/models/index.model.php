<?php

/*
    Modelo principal del proyecto CRUD de articulos POO
*/

#simbolo moneda local
setlocale(LC_MONETARY, 'es_ES.UTF-8');

// Crea una instancia de la tabla de artículos 
$tabla_articulos = new Class_tabla_articulos();

// Cargar datos de ejemplo en la tabla de artículos
$tabla_articulos->get_datos();

// Obtener los datos de los artículos
$articulos = $tabla_articulos->articulos;


// Obtener las categorías disponibles
$categorias = Class_tabla_articulos::get_Categorias();

// Obtener las marcas disponibles
$marcas = Class_tabla_articulos::get_marcas();




?>