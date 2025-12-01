<?php

/*
    modelo: show.model.php
    descripción: obtiene los datos del formulario de edición de un corredor  

    Método GET:

            - id del corredor
    
*/

// Obtener id del corredor a mostrar
$corredor_id = $_GET['id'] ?? null;

// Validar id (omitir para simplificar)

// Conexión a la base de datos
$conexion = new class_tabla_corredores();

// Obtener datos del corredor
$corredor = $conexion->read($corredor_id);

// Obtener array de cursos

$categorias = $conexion->get_categoria();
$clubs = $conexion->get_club();
?>