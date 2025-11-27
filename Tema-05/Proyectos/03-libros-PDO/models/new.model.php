<?php

/*
    modelo: new.model.php
    descripción: modelo para mostrar el formulario nuevo libro
*/

// Conexión a la base de datos
$conexion = new class_tabla_libros();

// Obtener array asociativo id=>nombre de autores
$autores = $conexion->get_autores();

// Obtener array asociativo id=>nombre de editoriales
$editoriales = $conexion->get_editoriales();

// Obtener array asociativo id=>nombre de temas
$temas = $conexion->get_temas();

?>