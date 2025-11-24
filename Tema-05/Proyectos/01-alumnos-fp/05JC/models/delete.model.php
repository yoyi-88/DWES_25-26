<?php

/*
    modelo: delete.model.php
    descripción: obtiene los datos del formulario para eliminar un alumno  

    Método GET:

            - id del alumno
    
*/

// Obtener id del alumno a eliminar
$alumno_id = $_GET['id'] ?? null;

// Validar id (omitir para simplificar)

// Conexión a la base de datos
$conexion = new class_tabla_alumnos();

// Obtener datos del alumno
$alumno = $conexion->delete($alumno_id);

// Obtener array de cursos

$conexion->mysqli->close();

