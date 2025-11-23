<?php
    /*
        modelo: create.model.php
        descripción: modelo para insertar un nuevo alumnno en el index
    */

    // Conexión a la base de datos
    $conexion = new class_tabla_alumnos('localhost', 'root', '', 'fp');


    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $email = $_POST['email'] ?? NULL; // Puede ser NULL si el campo del form está vacío
    $dni = $_POST['dni'] ?? '';
    $telefono = $_POST['telefono'] ?? NULL;
    $nacionalidad = $_POST['nacionalidad'] ?? NULL;
    $fecha_nac = $_POST['fecha_nac'] ?? NULL;
    $curso_id = $_POST['curso_id'] ?? 0; // El ID del curso, debe ser un número entero

    // Los campos que NO tienes en el formulario los asignamos a NULL, 
    // ya que deben aceptarlo en la tabla 'alumnos'.
    $direccion = NULL; 
    $poblacion = NULL;
    $provincia = NULL;

    // Llamar al método de la clase (EL OBJETO)
    $conexion->create(
        $nombre, 
        $apellidos, 
        $email, 
        $telefono, 
        $direccion, 
        $poblacion, 
        $provincia, 
        $nacionalidad, 
        $dni, 
        $fecha_nac, 
        $curso_id
    );



?>