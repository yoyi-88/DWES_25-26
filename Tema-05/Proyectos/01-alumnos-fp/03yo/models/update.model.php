<?php
    /*
        modelo: create.model.php
        descripción: modelo para insertar un nuevo alumnno en el index
    */

        

    // Obtener id del alumno a actualizar
    $alumno_id = $_GET['id'] ?? null;

    // Recoger datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $email = $_POST['email'] ?? NULL; 
    $dni = $_POST['dni'] ?? '';
    $telefono = $_POST['telefono'] ?? NULL;
    $nacionalidad = $_POST['nacionalidad'] ?? NULL;
    $fecha_nac = $_POST['fecha_nac'] ?? NULL;
    $curso_id = $_POST['curso_id'] ?? 0;

    // Crear objeto alumno
    $alumno = new class_alumno(
        null,
        $nombre,
        $apellidos,
        $email,
        $telefono,
        $nacionalidad,
        $dni,
        $fecha_nac,
        $curso_id
    );

    // Conexión a la base de datos
    $conexion = new class_tabla_alumnos('localhost', 'root', '', 'fp');

    // Actualizar alumno
    $conexion->update($alumno, $alumno_id);



?>