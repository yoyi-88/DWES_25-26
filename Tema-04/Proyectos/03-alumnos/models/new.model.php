<?php 
/*
genera los datos necesarios para el formulario de creación de un nuevo artículo
*/ 
// Obtener los cursos disponibles
$cursos = Class_tabla_alumnos::get_curso();

// Obtener las asignaturas disponibles
$asignaturas = Class_tabla_alumnos::get_Asignaturas();



?>