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
$tabla_alumnos = new Class_tabla_alumnos();

// Cargar los datos
$tabla_alumnos->get_datos();


// Obtener los detalles del artículo mediante un objeto de la clase artículo

// Obtener el índice del array en el que se encuentra el objeto de la clase artículo
$indice = $tabla_alumnos->get_indice_from_id($id);

// Obtener el objeto de la clase alumno
$alumno = $tabla_alumnos->get_alumno_from_indice($indice);

// Obtener los cursos disponibles
$cursos = Class_tabla_alumnos::get_curso();

// Obtener las asignaturas disponibles
$asignaturas = Class_tabla_alumnos::get_Asignaturas();





?>