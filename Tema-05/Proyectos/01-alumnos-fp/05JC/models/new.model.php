<?php

/*
    modelo: new.model.php
    descripción: modelo para insertar un nuevo alumno   
*/

// Conexión a la base de datos
$conexion = new class_tabla_alumnos('localhost', 'root', '', 'fp');

// Obtener array asociativo con los cursos de índice id y curso
$cursos = $conexion->get_cursos();

?>