<?php
    /*
        modelo: new.model.php
        descripción: modelo para insertar un nuevo alumnno
    */

    // Conexión a la base de datos
    $conexion = new class_tabla_alumnos('localhost', 'root', '', 'fp');

    // Obtener array asociativo con los cursos
    $cursos = $conexion->get_cursos();



?>