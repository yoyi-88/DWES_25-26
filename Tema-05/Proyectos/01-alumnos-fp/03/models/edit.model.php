<?php
    /*
        modelo: new.model.php
        descripción: modelo para insertar un nuevo alumnno
    */

    $alumno_id = $_GET['id'] ?? null;

    // Conexión a la base de datos
    $conexion = new class_tabla_alumnos('localhost', 'root', '', 'fp');

    $alumno = $conexion->read($alumno_id);

    // Obtener array asociativo con los cursos
    $cursos = $conexion->get_cursos();



?>