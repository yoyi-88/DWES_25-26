<?php

/*
    Obtiene los detalles del alumno editado
*/

// Cargo el id del alumno (de la URL)
$id_editar = $_GET['id'] ?? null;

// Cargar los detalles del formulario (de POST)

// El ID del alumno (campo readonly del formulario)
$id = $_POST['id'] ?? null; 

// Campos de Class_alumno
$nombre = $_POST['nombre'] ?? null;
$apellidos = $_POST['apellidos'] ?? null;
$email = $_POST['email'] ?? null;
$f_nacimiento = $_POST['f_nacimiento'] ?? null;
$curso = $_POST['curso'] ?? null; // Índice del curso
$asignaturas = $_POST['asignaturas'] ?? []; // Array de índices de asignaturas


// Validación (Aquí iría tu lógica de validación)

// Creo un objeto de la clase alumno a partir de los detalles del formulario
$alumno = new Class_alumno(
    $id,
    $nombre,
    $apellidos,
    $email,
    $f_nacimiento,
    $curso,
    $asignaturas
);

// Crear un objeto o instacia de la clase tabla_alumnos
$tabla_alumnos = new Class_tabla_alumnos();

// Cargar los datos (ej: de sesión o fichero)
$tabla_alumnos->get_datos();

// Obtener el índice de la tabla alumnos de dicho alumno
$indice = $tabla_alumnos->get_indice_from_id($id_editar);

// Actualizo la tabla de alumnos
$tabla_alumnos->update($alumno, $indice);

// Obtener array de objetos de la clase alumnos
$alumnos = $tabla_alumnos->get_alumnos();

// --- Búsqueda y carga de datos para la vista (si fuesen necesarios) ---

// Obtener los cursos disponibles
$cursos = Class_tabla_alumnos::get_curso();

// Obtener las asignaturas disponibles
$asignaturas = Class_tabla_alumnos::get_Asignaturas();

?>