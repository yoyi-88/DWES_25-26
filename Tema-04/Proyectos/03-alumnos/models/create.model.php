<?php

/*
    Obtiene los detalles del formulario y añade nuevo artículo
*/



// Crear un objeto o instacia de la clase tabla_articulos
$tabla_alumnos = new Class_tabla_alumnos();

// Cargar los datos
$tabla_alumnos->get_datos();

// Cargar los detalles del formulario
$id = $tabla_alumnos->get_next_id();
$nombre = $_POST['nombre'] ?? null;
$apellidos = $_POST['apellidos'] ?? null;
$email = $_POST['email'] ?? null;
$f_nacimiento = $_POST['f_nacimiento'] ?? null;
$curso = $_POST['curso'] ?? null; // Índice del curso
$asignaturas = $_POST['asignaturas'] ?? []; // Array de índices de asignaturas


// Validación

// Creo un objeto de la clase artículos a partir de los detalles del formulario
$alumno = new Class_alumno(
    $id,
    $nombre,
    $apellidos,
    $email,
    $f_nacimiento,
    $curso,
    $asignaturas
);  

// Añade nuevo objeto a la tabla
$tabla_alumnos->create($alumno);

// Obtener array de objetos de la clase artículos
$alumnos = $tabla_alumnos->get_alumnos();

// Obtener los cursos disponibles
$cursos = Class_tabla_alumnos::get_curso();

// Obtener las asignaturas disponibles
$asignaturas = Class_tabla_alumnos::get_Asignaturas();





?>