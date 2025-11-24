<?php
    /*
        Controlador: index.php
        descripción: controlador principal proyeecto gestión alumnos
    */

    // Clases 
    require_once('class/alumno.class.php');
    require_once('class/conexion.class.php');
    require_once('class/tabla_alumnos.class.php');

    // Modelo
    require_once('models/update.model.php');
    
    // Cargo controlador index mediante redirección
    header('Location: index.php');

?>