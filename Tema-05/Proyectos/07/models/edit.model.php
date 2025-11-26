<?php

/*
    modelo: edit.model.php
    descripción: obtiene los datos del formulario de edición de un alumno  

    Método GET:

            - id del alumno
    
*/

// Obtener id del alumno a editar
$alumno_id = $_GET['id'] ?? null;

// Validar id (omitir para simplificar)

// Conexión a la base de datos
$conexion = new class_tabla_alumnos();

// Obtener datos del alumno
$alumno = $conexion->read($alumno_id);

// Obtener array de cursos

$cursos = $conexion->get_cursos();


