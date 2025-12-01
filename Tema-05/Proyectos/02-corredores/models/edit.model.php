<?php

/*
    modelo: edit.model.php
    descripción: obtiene los datos del formulario de edición de un alumno  

    Método GET:

            - id del alumno
    
*/

// Obtener id del alumno a editar
$corredor_id = $_GET['id'] ?? null;

// Validar id (omitir para simplificar)

// Conexión a la base de datos
$conexion = new class_tabla_corredores();

// Obtener datos del alumno
$corredor = $conexion->read($corredor_id);

// Obtener array de cursos

$categorias = $conexion->get_categoria();
$clubs = $conexion->get_club();
?>